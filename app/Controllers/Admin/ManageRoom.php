<?php

namespace App\Controllers\Admin;

use App\Libraries\Model;
use App\Controllers\BaseController;


class ManageRoom extends BaseController
{
    public function view()
    {
        $rooms = Model::room()->findAll();
        //tambah filter

        return view('rooms/view_room', ['rooms' => $rooms]);
    }
    public function createView()
    {
        return view('rooms/create_room');
    }
    public function create()
    {
        $data = [
            'roomId' => Post('roomId'),
            'roomName' => Post('roomName'),
            'status' => Post('status') ?? 'available'
        ];

        Model::room()->insert($data);

        return redirect()->to('admin/rooms/view');
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
            'roomName' => Post('roomName'),
            'status' => Post('status'),
        ];

        Model::room()->where('roomId', $roomId)->set($data)->update();

        return redirect()->to('admin/rooms/view');
    }

    public function delete($roomId)
    {
        Model::room()->where('roomId', $roomId)->delete();
        return redirect()->to('admin/rooms/view');
    }
}
