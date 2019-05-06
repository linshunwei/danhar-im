<?php

namespace Linshunwei\DanharIm;

use GuzzleHttp\Client;

/**
 *  东合IM 服务端接口
 *  author:linshunwei
 */

class DanharIm
{
	private $app_id = '';
	private $app_secret = '';
	private $host = '';
	private $token = '';


	public function __construct()
	{
		$this->app_id = config('danhar-im.app_id');
		$this->app_secret = config('danhar-im.app_secret');
		$this->host = config('danhar-im.host');

		$this->token = $this->getToken();
	}

	/**
	 *  创建用户
	 * @param string $accid
	 * @return mixed
	 */
	public function userCreate($uniqueid = '', $name = '', $icon = '')
	{
		$data = [
			'uniqueid' => $uniqueid,
			'name' => $name,
			'icon' => $icon,
		];
		$result = $this->request_post($this->host . "/api/im/user/create", $data);
		return $result;
	}

	/**
	 * 更新用户
	 */
	public function userUpdate($accid = '', $token = '')
	{
		$data = [
			'accid' => $accid,
			'token' => $token,
		];
		$result = $this->request_post($this->host . "/api/im/user/update", $data);
		return $result;
	}

	/**
	 * 更新用户
	 */
	public function userUpdateInfo($accid = '', $name = '', $icon = '')
	{
		$data = [
			'accid' => $accid,
			'name' => $name,
			'icon' => $icon,
		];
		$result = $this->request_post($this->host . "/api/im/user/update_info", $data);
		return $result;
	}

	/**
	 * 用户信息
	 */
	public function userInfo($accid = '')
	{
		$data = [
			'accids' => $accid
		];
		$result = $this->request_post($this->host . "/api/im/user/info", $data);
		return $result;
	}

	/**
	 * 更新token
	 */
	public function userRefreshToken($accid = '')
	{
		$data = [
			'accid' => $accid
		];
		$result = $this->request_post($this->host . "/api/im/user/refresh_token", $data);
		return $result;
	}

	/**
	 * 禁用
	 * @param string $accid
	 * @param bool $needkick
	 * @return array
	 */
	public function userBlock($accid = '', $needkick = false)
	{
		$data = [
			'accid' => $accid,
			'needkick' => $needkick
		];
		$result = $this->request_post($this->host . "/api/im/user/block", $data);
		return $result;
	}

	/**
	 * 解禁
	 * @param string $accid
	 * @param bool $needkick
	 * @return array
	 */
	public function userUnblock($accid = '')
	{
		$data = [
			'accid' => $accid,
		];
		$result = $this->request_post($this->host . "/api/im/user/unblock", $data);
		return $result;
	}


	/**
	 * 全局禁言
	 * @param string $accid
	 * @param bool $mute 是否全局禁言：true：全局禁言，false:取消全局禁言
	 * @return array
	 */
	public function userMute($accid = '', $mute = true)
	{
		$data = [
			'accid' => $accid,
			'mute' => $mute,
		];
		$result = $this->request_post($this->host . "/api/im/user/action", $data);
		return $result;
	}

	/**
	 * 全局禁用
	 * @param string $accid
	 * @param bool $mute 是否全局禁言：true：全局禁言，false:取消全局禁言
	 * @return array
	 */
	public function userMuteAv($accid = '', $mute = true)
	{
		$data = [
			'accid' => $accid,
			'mute' => $mute,
		];
		$result = $this->request_post($this->host . "/api/im/user/mute_av", $data);
		return $result;
	}

	/**
	 *  创建群
	 * @param string $tname
	 * @param string $owner
	 * @param array $members
	 * @param string $msg
	 * @param int $magree
	 * @param int $joinmode
	 * @return array
	 */
	public function teamCreate($tname = '', $owner = '', $members = [], $msg = '邀请进群', $magree = 0, $joinmode = 0)
	{
		$data = [
			'tname' => $tname,
			'owner' => $owner,
			'members' => $members,
			'magree' => $magree,
			'msg' => $msg,
			'joinmode' => $joinmode
		];
		$result = $this->request_post($this->host . "/api/im/team/create", $data);
		return $result;
	}

	/**
	 * 群详情
	 * @param $tid
	 * @return array
	 */
	public function teamDetail($tid)
	{
		$data = [
			'tid' => $tid,
		];
		$result = $this->postDataCurl($this->host . "/nimserver/team/queryDetail.action", $data);
		return $result;
	}

	/**
	 * 团队添加
	 * @param string $tid
	 * @param string $owner
	 * @param array $members
	 * @param string $msg
	 * @param int $magree
	 * @return array
	 */
	public function teamAdd($tid = '', $owner = '', $members = [], $msg = '邀请进群', $magree = 0)
	{
		$data = [
			'tid' => $tid,
			'owner' => $owner,
			'members' => $members,
			'magree' => $magree,
			'msg' => $msg,
		];
		$result = $this->request_post($this->host . "/api/im/team/add", $data);
		return $result;
	}

	/**
	 * 移除群
	 * @param string $tid
	 * @param string $owner
	 * @param string $member
	 * @param array $members
	 * @return array
	 */
	public function teamKick($tid = '', $owner = '', $member = '', $members = [])
	{
		$data = [
			'tid' => $tid,
			'owner' => $owner,
			'members' => $members,
			'member' => $member,
		];
		$result = $this->request_post($this->host . "/api/im/team/kick", $data);
		return $result;
	}

	/**
	 * 移交群主
	 * @param string $tid
	 * @param string $owner
	 * @param string $leave 1:群主解除群主后离开群，2：群主解除群主后成为普通成员。其它414
	 * @return array
	 */
	public function teamChangeOwner($tid = '', $owner = '', $newowner = '', $leave = 2)
	{
		$data = [
			'tid' => $tid,
			'owner' => $owner,
			'newowner' => $newowner,
			'leave' => $leave,
		];
		$result = $this->request_post($this->host . "/api/im/team/leave", $data);
//		$result = $this->postDataCurl($this->host . "/nimserver/team/changeOwner.action", $data);
		return $result;
	}


	/**
	 * 设置管理员
	 * @param string $tid
	 * @param string $owner
	 * @param array $members
	 * @return array
	 */
	public function teamAddManager($tid = '', $owner = '', $members = [])
	{
		$data = [
			'tid' => $tid,
			'owner' => $owner,
			'members' => $members,
		];
		$result = $this->request_post($this->host . "/api/im/team/add_manager", $data);
		return $result;
	}

	/**
	 * 移除管理员
	 * @param string $tid
	 * @param string $owner
	 * @param array $members
	 * @return array
	 */
	public function teamRemoveManager($tid = '', $owner = '', $members = [])
	{
		$data = [
			'tid' => $tid,
			'owner' => $owner,
			'members' => $members,
		];
		$result = $this->request_post($this->host . "/api/im/team/remove_manager", $data);
		return $result;
	}

	/**
	 * 禁言群组某人
	 * @param string $tid
	 * @param string $owner
	 * @param string $accid
	 * @param int $mute
	 * @return array
	 */
	public function teamMuteTlist($tid = '', $owner = '', $accid = '', $mute = 1)
	{
		$data = [
			'tid' => $tid,
			'owner' => $owner,
			'mute' => $mute,
			'accid' => $accid,
		];
		$result = $this->request_post($this->host . "/api/im/team/mute_tlist", $data);
		return $result;
	}

	/**
	 * @param string $tid
	 * @param string $owner
	 * @param int $mute true:禁言，false:解禁(mute和muteType至少提供一个，都提供时按mute处理)
	 * @param int $muteType 禁言类型 0:解除禁言，1:禁言普通成员 3:禁言整个群(包括群主)
	 * @return array
	 */
	public function teamMuteTlistAll($tid = '', $owner = '', $mute = '', $muteType = 0)
	{
		$data = [
			'tid' => $tid,
			'owner' => $owner,
			'mute' => $mute,
			'muteType' => $muteType,
		];
		$result = $this->request_post($this->host . "/api/im/team/mute_tlist_all", $data);
		return $result;
	}

	/**
	 * 禁言列表
	 * @param string $tid
	 * @param string $owner
	 * @return array
	 */
	public function teamListTeamMute($tid = '', $owner = '')
	{
		$data = [
			'tid' => $tid,
			'owner' => $owner,
		];
		$result = $this->request_post($this->host . "/api/im/team/list_team_mute", $data);
		return $result;
	}

	public function msgList($convType = '', $msgType = '', $to = '', $start_at = '', $end_at = '', $fromAccount = '', $page = '1', $limit = '15')
	{
		$data = [
			'convType' => $convType,
			'msgType' => $msgType,
			'to' => $to,
			'fromAccount' => $fromAccount,
			'start_time' => $start_at ? strtotime($start_at) * 1000 : '',
			'end_time' => $end_at ? strtotime($end_at) * 1000 : '',
			'page' => $page,
			'limit' => $limit,
		];
		$result = $this->request_post($this->host . "/api/im/msg/list", $data);
		return $result;
	}


	public function getToken()
	{
		$data = [
			'app_id' => $this->app_id,
			'app_secret' => $this->app_secret,
		];
		$url = $this->host . '/api/auth/token';

		$res = $this->request_post($url, $data);

		if ($res['code'] == 200) {
			return $res['data']['access_token'];
		}
	}

	private function request_post($url, $data = null)
	{
		$_data = [
			'query' => $data,
		];

		$header = [];
		if ($this->token) {
			$header['Authorization'] = $this->token;
		}
		if ($header) {
			$_data['headers'] = $header;
		}
		$client = new Client();
		$res = $client->request('Post', $url, $_data);

		return $this->object_to_array(json_decode($res->getBody()->getContents()));
	}

	private function object_to_array($obj)
	{
		$obj = (array)$obj;
		foreach ($obj as $k => $v) {
			if (gettype($v) == 'resource') {
				return;
			}
			if (gettype($v) == 'object' || gettype($v) == 'array') {
				$obj[$k] = (array)$this->object_to_array($v);
			}
		}

		return $obj;
	}

}