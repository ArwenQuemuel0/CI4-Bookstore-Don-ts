<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RequestsModel;

class Request extends BaseController
{
    public function submit()
    {
        $session = session();

        if (!$session->has('user')) {
            return redirect()->to('/loginPage');
        }

        $model = new RequestsModel();

        $data = [
            'requester_name' => $this->request->getPost('requester_name'),
            'requested_data' => $this->request->getPost('requested_data'),
            'message'        => $this->request->getPost('message'),
            'status'         => 'pending', // default
        ];

        $model->insert($data);

        return redirect()->back()->with('success', 'Your request has been submitted!');
    }
}
