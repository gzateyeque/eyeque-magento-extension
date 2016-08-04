<?php
/**
 * Copyright © 2016 EyeQue. All rights reserved.
 * Yuan Xiong
 */

namespace EyeQue\EyeCloudAccess;

class EyeCloudConstants
{
	const EYECLOUD_SERVER = 'http://192.168.110.85:8080';// The eyecloud ip address
	const DOCUMENT_API_PHP = 'http://192.168.110.151:8988/documentControl.php';// The private document api server, should be only accessable from magento
	const DOCUMENT_USER_PROFILE = 'http://192.168.110.151:8987/index.html';//The public document user profile server, allow visiting from all

        const EYECLOUD_API_UPLOAD = self::EYECLOUD_SERVER . '/eyecloud/api/V2/tests';
	const EYECLOUD_API_GET_DEVICE_PARAMETERSN = self::EYECLOUD_SERVER . '/eyecloud/api/V2/devices';
	const EYECLOUD_API_GET_TEST_RESULT = self::EYECLOUD_SERVER . '/eyecloud/api/V2/results';
        const EYECLOUD_API_GET_VISION_RECORD = self::EYECLOUD_SERVER . '/eyecloud/api/V2/testrecords';
	const EYECLOUD_API_GET_MAX_TESTID = self::EYECLOUD_SERVER . '/eyecloud/api/V2/results?maxID=true';
        const EYECLOUD_HARD_CODE_ACCESS_TOKEN = 'e46cghc52pqd8kvgqmv8ovsi1ufcfetg';
        const DOCUMENT_USER_HASH_PADDING = "EyeQue is a company with one simple focus – provide cool vision technologies to the world at the lowest possible cost. We specialize in vision assessments and founded on the company on the simple belief that it is possible to make use of the internet to improve eye care. Optical Vision Devices will soon be joining the growing array of the Internet of Things.";
        
	

}
