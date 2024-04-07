<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Handlers\AuthHandler;
use App\Models\QrCodes;
use App\Http\Handlers\QrCodeHandler;


class QrcodeController extends Controller
{
    public $authUser;

    public function index() {
        $this->authUser = \App\Http\Handlers\AuthHandler::getAuthUser();

        return view('qrcode', [
            'user' => $this->authUser
        ]);
    }

    public function new(Request $request) {
        $request->validate([
            'name' => 'required|min:1'
        ]);

        $qrcode = \App\Http\Handlers\QrCodeHandler::generate($request->name);

        $status = ($request->status == 'on') ? 'Ativado' : 'Desativado';

        QrCodes::create([
            'name' => $request->name,
            'qrcode' => $qrcode,
            'status' => $status
        ]);

        return redirect(route('qrcode'))->withErrors(['ok' => 'QRCode criado com sucesso!']);
    }

    public function edit(Request $request) {
        $request->validate([
            'name' => 'required|min:1',
            'id' => 'required'
        ]);

        $qrcode = \App\Http\Handlers\QrCodeHandler::generate($request->name);

        $status = ($request->status == 'on') ? 'Ativado' : 'Desativado';

        QrCodes::where('id', $request->id)->update([
            'name' => $request->name,
            'qrcode' => $qrcode,
            'status' => $status
        ]);

        return redirect(route('qrcode'))->withErrors(['ok' => 'QRCode atualizado com sucesso!']);
    }

    public function download(Request $request) {
        $qrcode = QrCodes::find($request->id);

        return view('qrcode_download', [
            'qrcode' => $qrcode
        ]);
    }

    public function delete(Request $request) {
        if($request->id) {
            QrCodes::where('id', $request->id)->delete();
        }

        return redirect(route('qrcode'))->withErrors(['ok' => 'QRCode excluído com sucesso!']);
    }
}
