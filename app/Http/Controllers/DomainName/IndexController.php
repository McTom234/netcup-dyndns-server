<?php

namespace App\Http\Controllers\DomainName;

use App\Http\Controllers\Controller;
use App\Http\Requests\DomainName\CreateRequest;
use App\Models\DomainName;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(DomainName::class);
    }

    public function index(Request $request)
    {
        $domainNameQuery = DomainName::with(['user']);
        if ($request->has('filterUserId')) {
            $domainNameQuery = $domainNameQuery->where('user_id', $request->get('filterUserId'));
        }

        $domainNames = $domainNameQuery->get();
        return response()->json($domainNames);
    }

    public function show(DomainName $domainName)
    {
        return response()->json($domainName->loadMissing(['user']));
    }

    public function store(CreateRequest $request)
    {
        $domainName = DomainName::make([
            'domain_name' => $request->input('domain_name'),
            'user_id' => auth()->id(),
        ]);
        $domainName->save();

        return response(status: Response::HTTP_CREATED);
    }

    public function destroy(DomainName $domainName)
    {
        $domainName->delete();

        return response(status: Response::HTTP_NO_CONTENT);
    }
}
