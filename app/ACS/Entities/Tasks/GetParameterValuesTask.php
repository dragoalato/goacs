<?php
declare(strict_types=1);

namespace App\ACS\Entities\Tasks;

use App\ACS\Context;
use App\ACS\Request\ACSRequest;
use App\ACS\Request\GetParameterValuesRequest;

class GetParameterValuesTask extends Task implements WithRequest
{

    public function toRequest(Context $context): ACSRequest
    {
        $request = new GetParameterValuesRequest($context);
        $request->setParameters($this->payload['parameters']);
        return $request;
    }
}
