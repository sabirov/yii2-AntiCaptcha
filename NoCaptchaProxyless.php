<?php
/**
 * @since        08.04.17
 * @author        Dmitriy Sabirov
 * @email        web8dew@yandex.ru
 */

namespace Sabirov\antiCaptcha;


class NoCaptchaProxyless extends AntiCaptcha implements AntiCaptchaTaskProtocol {

	private $websiteUrl;
	private $websiteKey;
	private $websiteSToken;

	public function getPostData() {
		return array(
			"type"          => "NoCaptchaTaskProxyless",
			"websiteURL"    => $this->websiteUrl,
			"websiteKey"    => $this->websiteKey,
			"websiteSToken" => $this->websiteSToken,
		);
	}

	public function setTaskInfo( $taskInfo ) {
		$this->taskInfo = $taskInfo;
	}

	public function getTaskSolution() {
		return $this->taskInfo->solution->gRecaptchaResponse;
	}

	public function setWebsiteURL( $value ) {
		$this->websiteUrl = $value;
	}

	public function setWebsiteKey( $value ) {
		$this->websiteKey = $value;
	}

	public function setWebsiteSToken( $value ) {
		$this->websiteSToken = $value;
	}
}