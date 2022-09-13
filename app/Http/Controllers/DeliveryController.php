<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Exception;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index()
    {
        $deliveries = Delivery::all();

        return view('pages.delivery.index', [
            'deliveries' => $deliveries
        ]);
    }

    public function search(Request $request)
    {
        try {
            $filters = $request->only('title', 'completed', 'date_start', 'date_end');

            if (isset($filters['date_start'])) {
                $filters['date_start'] = formatDateAndTime($filters['date_start'], 'Y-m-d H:i:s');
            }

            if (isset($filters['date_end'])) {
                $filters['date_end'] = formatDateAndTime($filters['date_end'], 'Y-m-d H:i:s');
            }

            if (isset($filters['date_start']) && isset($filters['date_end'])) {
                if ($filters['date_end'] < $filters['date_start']) {
                    throw new Exception('Data inicial deve ser superior a final.');
                }
            }

            $deliveries = Delivery::search($filters);

            if (isset($filters['date_start'])) {
                $filters['date_start'] = formatDateAndTime($filters['date_start'], 'Y-m-d') . 'T' . formatDateAndTime($filters['date_start'], 'H:i');
            }
            if (isset($filters['date_end'])) {
                $filters['date_end'] = formatDateAndTime($filters['date_end'], 'Y-m-d') . 'T' . formatDateAndTime($filters['date_start'], 'H:i');
            }

            return view('pages.delivery.index', [
                'filters' => $filters,
                'deliveries' => $deliveries
            ]);
        } catch (Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    public function create()
    {
        return view('pages.delivery.create');
    }

    public function store(Request $request)
    {
        try {
            $data = $request->except('_token');
            $data['completed'] = isset($request['completed']) ? true : false;
            $data['deadline'] = formatDateAndTime($data['deadline'], 'Y-m-d H:i:s');

            $delivery = Delivery::create($data);

            return redirect()->route('delivery.index')->with('success', 'Sucesso ao salvar!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $delivery = Delivery::find($id);

        if (!$delivery)
            return redirect()->route('delivery.index')->with('error', 'Entrega não encontrada.');

        $delivery['deadline'] = formatDateAndTime($delivery['deadline'], 'Y-m-d') . 'T' . formatDateAndTime($delivery['deadline'], 'H:i');

        return view('pages.delivery.edit', ['delivery' => $delivery]);
    }

    public function update(Request $request, $id)
    {
        try {
            $delivery = Delivery::find($id);

            if (!$delivery)
                return redirect()->back();

            $dataUpdate = $request->except('_token');
            $dataUpdate['completed'] = isset($request['completed']) ? true : false;
            $dataUpdate['deadline'] = formatDateAndTime($dataUpdate['deadline'], 'Y-m-d H:i:s');

            $delivery->update($dataUpdate);

            return redirect()->route('delivery.index')->with('success', 'Alterado com sucesso.');
        } catch (Exception $ex) {
            $error = [
                'message' => 'Ocorreu um erro ao salvar: ' . $ex->getMessage()
            ];
            return redirect()->back()->with('error', $error['message']);
        }
    }

    public function destroy($id)
    {
        try {
            $delivery = Delivery::find($id);

            if (!$delivery)
                return redirect()->back();

            $delivery->delete();

            return response()->json(['success' => true, 'message' => 'Excluido com sucesso.']);
        } catch (Exception $ex) {
            $error = [
                'message' => 'Ocorreu um erro ao salvar: ' . $ex->getMessage()
            ];
            return redirect()->back()->with('error', $error['message']);
        }
    }
}
