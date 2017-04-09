<?php
/**
 * @since        08.04.17
 * @author        Dmitriy Sabirov
 * @email        web8dew@yandex.ru
 */

namespace Sabirov\AntiCaptcha;


interface AntiCaptchaTaskProtocol {
	public function getPostData();
	public function setTaskInfo($taskInfo);
	public function getTaskSolution();
}