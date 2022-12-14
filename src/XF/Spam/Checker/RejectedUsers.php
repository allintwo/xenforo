<?php

namespace XF\Spam\Checker;

class RejectedUsers extends AbstractProvider implements UserCheckerInterface
{
	protected function getType()
	{
		return 'RejectedUsers';
	}

	public function check(\XF\Entity\User $user, array $extraParams = [])
	{
		$option = $this->app()->options()->approveSharedBannedRejectedIp;

		$ip = \XF\Util\Ip::convertIpStringToBinary(
			$this->app()->request()->getIp()
		);
		if ($ip === false)
		{
			$this->logDecision('allowed');
			return;
		}

		$ipFinder = $this->app()->finder('XF:Ip')
			->with('User', true)
			->where('User.user_state', 'rejected')
			->where('ip', $ip)
			->order('log_date', 'DESC')
			->pluckFrom('User', 'user_id');

		if ($option['days'])
		{
			$ipFinder->where('log_date', '>', (time() - $option['days'] * 86400));
		}

		$bannedNames = $ipFinder->fetch()->pluckNamed('username');
		if ($bannedNames)
		{
			$this->logDetail('shared_ip_rejected_user_x', [
				'users' => implode(', ', $bannedNames)
			]);
			$this->logDecision('moderated');
			return;
		}

		$this->logDecision('allowed');
		return;
	}

	public function submit(\XF\Entity\User $user, array $extraParams = [])
	{
		return;
	}
}