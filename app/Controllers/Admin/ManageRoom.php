<?php

namespace App\Controllers\Admin;

use App\Libraries\Model;
use App\Controllers\BaseController;

class ManageRoom extends BaseController
{
    public function view()
    {
        $rooms = Model::room()->findAll();
        return view('rooms/view_room', ['rooms' => $rooms]);
    }

    public function createView()
    {
        return view('rooms/create_room');
    }

    public function create()
    {
        $data = [
            'roomId' => $this->request->getPost('roomId'),
            'roomName' => $this->request->getPost('roomName'),
            'status' => $this->request->getPost('status') ?? 'available'
        ];

        // Handle image upload
        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/rooms/', $newName);
            $data['image'] = $newName;
        }

        Model::room()->insert($data);

        return redirect()->to('admin/rooms/view')->with('success', 'Room created successfully');
    }

    public function editView($roomId)
    {
        $room = Model::room()->where('roomId', $roomId)->first();
        if (!$room) {
            return redirect()->to('admin/rooms/view')->with('error', 'Room not found.');
        }

        return view('rooms/edit_room', ['room' => $room]);
    }

    public function edit($roomId)
    {
        $data = [
            'roomName' => $this->request->getPost('roomName'),
            'status' => $this->request->getPost('status'),
        ];

        // Handle new image upload
        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/rooms/', $newName);
            $data['image'] = $newName;
        }

        Model::room()->where('roomId', $roomId)->set($data)->update();

        return redirect()->to('admin/rooms/view')->with('success', 'Room updated successfully');
    }

    public function delete($roomId)
    {
        $room = Model::room()->where('roomId', $roomId)->first();

        if ($room && !empty($room['image'])) {
            // Delete the image file if exists
            $imagePath = FCPATH . 'uploads/rooms/' . $room['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        Model::room()->where('roomId', $roomId)->delete();
        return redirect()->to('admin/rooms/view')->with('success', 'Room deleted successfully');
    }
}
