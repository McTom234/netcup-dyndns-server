<?php

namespace App\Services\Netcup;

use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class ApiService
{
    private string|null $apiSessionId = null;

    public function __construct(
        private readonly int $customerNumber,
        private readonly string $apiKey,
        private readonly string $apiPassword,
        private readonly string $apiEndpoint,
    ) {
        $this->login();
    }

    /**
     * @throws Exception
     */
    private function performAction(string $action, array|Collection $param, bool $withSessionId = true): Response
    {
        if ($param instanceof Collection) {
            $param = $param->all();
        }
        if ($withSessionId) {
            if (!$this->apiSessionId) {
                throw new Exception('Tried to authenticate with API without session id. The login failed probably.');
            }
            $param = array_merge(['apisessionid' => $this->apiSessionId]);
        }

        return Http::retry(5, 3000)->asJson()->acceptJson()
            ->post($this->apiEndpoint, compact('action', 'param'));
    }

    private function login(): void
    {
        $response = $this->performAction('login', [
            'apikey' => $this->apiKey,
            'apipassword' => $this->apiPassword,
            'customernumber' => $this->customerNumber,
        ], false);
        dd($response);
        $this->apiSessionId = '';
    }

    public function logout(): void
    {
        $this->apiSessionId = null;
    }

    public function __destruct()
    {
        $this->logout();
    }


}
