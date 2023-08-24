<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\Admin\ReceiptRepositoryInterface;
use App\Http\Requests\Admin\ReceiptRequest;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    private $receipt;

    public function __construct(ReceiptRepositoryInterface $receipt)
    {
        $this->receipt = $receipt;
    }

    public function index()
    {
        return $this->receipt->index();
    }

    public function create()
    {
        return $this->receipt->create();
    }

    public function store(ReceiptRequest $request)
    {
       return $this->receipt->store($request);
    }

    public function show($id)
    {
        return $this->receipt->show($id);
    }

    public function edit($id)
    {
        return $this->receipt->edit($id);
    }

    public function update(ReceiptRequest $request)
    {
        return $this->receipt->update($request);
    }

    public function destroy($id)
    {
        return $this->receipt->destroy($id);
    }
}
