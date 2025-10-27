<?php

namespace App\Controllers\Admin;

use App\Models\RoomModel;
use App\Controllers\BaseController;

class ManageRoom extends BaseController
{
    protected $roomModel;

    public function __construct()
    {
        $this->roomModel = new RoomModel();
    }

    public function viewRoom()
    {
        $rooms = $this->roomModel->findAll();
        return view('admin/admin_rooms', ['rooms' => $rooms]);
    }

    public function create()
    {
        return view('rooms/create_room');
    }

    public function store()
    {
        $data = $this->request->getPost([
            'roomId',
            'roomName',
            'status'
        ]);

        $data['status'] = $data['status'] ?? 'available';
        $this->roomModel->insert($data);

        return redirect()->to('admin/rooms')->with('success', 'Room added successfully.');
    }


    public function edit($id)
    {
        $room = $this->roomModel->find($id);
        if (!$room) {
            return redirect()->to('admin/rooms')->with('error', 'Room not found.');
        }

        return view('rooms/edit_room', ['room' => $room]);
    }

    public function update($id)
    {
        $data = $this->request->getPost(['roomId', 'roomName', 'status']);
        $this->roomModel->update($id, $data);

        return redirect()->to('admin/rooms')->with('success', 'Room updated successfully.');
    }

    public function delete($id)
    {
        $this->roomModel->delete($id);
        return redirect()->to('admin/rooms')->with('success', 'Room deleted successfully.');
    }
}
