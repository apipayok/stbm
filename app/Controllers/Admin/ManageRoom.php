<?php

namespace App\Controllers\Admin;

use App\Models\RoomModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ManageRoom extends BaseController
{
    public function viewRoom()
    {
        $RoomModel = new RoomModel();
        $data['rooms'] = $RoomModel->findAll();

        return view('admin/admin_rooms', $data);
    }
    
    //open up create form
    public function create()
    {
        return view('rooms/create_room');
    }
    //store the created room
    public function store()
    {
        $RoomModel = new RoomModel();
        $data = [
            'roomId'   => $this->request->getPost('roomId'),
            'roomName' => $this->request->getPost('roomName'),
            'info'     => $this->request->getPost('info'),
        ];
        $RoomModel->save($data);

        return redirect()->to('admin/rooms');
    }

    //open edit form
    public function edit($id)
    {
        $RoomModel = new RoomModel();
        $data['rooms'] = $RoomModel->find($id);

        return view('rooms/edit_room', $data);
    }
    //update edited room
    public function update($id)
    {
        $RoomModel = new RoomModel();
        $data = [
            'roomId'   => $this->request->getPost('roomId'),
            'roomName' => $this->request->getPost('roomName'),
            'info'     => $this->request->getPost('info'),
        ];

        $RoomModel->update($id, $data);
        return redirect()->to('admin/rooms');
    }

    //delete room
    public function delete($id)
    {
        $RoomModel = new RoomModel();
        $RoomModel->delete($id);

        return redirect()->to('admin/rooms');
    }

}
    
