<?php

namespace App\Controllers\Admin;

use App\Libraries\Model;
use App\Controllers\BaseController;


class ManageRoom extends BaseController
{
    protected $method = ['view', 'create', 'edit'];

    public function room($action = 'view', $id = null)
    {
        if (!in_array($action, $this->method)) {
            return redirect()->to('/rooms/view_room');
        }

        $rooms = [];

        if ($action === 'view') {
            $rooms = Model::room()->findAll();
        } else if ($action === 'edit' && $id) {
            $rooms = Model::room()->find($id);
        }

        return view("rooms/{$action}_room", ['rooms' => $rooms]);
    }

    public function manage($action, $id = null)
    {
        if (!in_array($action, $this->method)) {
            return redirect()->to('/rooms/view_room');
        }

        $data = Post([
            'roomId',
            'roomName',
            'status'
        ]);

        if ($action === 'create') {
            $data['status'] = $data['status'] ?? 'available';
            Model::room()->insert($data);
        } else if ($action === 'edit') {
            Model::room()->update($id, $data);
        }
        
        return redirect()
        ->to('/admin/rooms/view_room')
        ->with('success', $action === 'create' ? 'Room Added' : 'Room Updated');

    }

    public function delete($id)
    {
        Model::room()->delete($id);
        return redirect()->to('admin/rooms')->with('success', 'Room deleted successfully.');
    }
}
