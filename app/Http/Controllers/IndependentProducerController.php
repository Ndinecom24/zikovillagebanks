<?php

namespace App\Http\Controllers;

use App\Models\FileUploads;
use App\Models\IndependentProducer;
use App\Models\Province;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class IndependentProducerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applications = IndependentProducer:: orderBy('id', 'ASC')->get();


        return view('independent_producers.index', compact(['applications']))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $provinces = Province::get();
        $statuses = Status::get();

        return view('independent_producers.create')->with(compact('user','provinces', 'statuses'));
    }


    public function store(Request $request)
    {

//        dd($request->all());
        $tech = substr($request->engagement_number, 0,3);
        $files = $request->allFiles();
        $date = Carbon::now();


        $docCount = 'RE/IPP/' . $tech . '/' . $date->month . $date->year . '00000' . IndependentProducer::count('id');
        $validatedData = $request->validate([
            'invoiced_services' => ['required'],
        ]);

        $ippcontract = IndependentProducer::updateOrCreate(

            [
                'system_ref' => $docCount,
                'invoiced_services' => $request->invoiced_services,
                'technology' => $request->technology,
                'engagement_number' => $request->engagement_number,
                'name_of_ipp' => $request->name_of_ipp,
                'date_of_application' => $request->date_of_application,
                'size_of_plant' => $request->size_of_plant,
                'size_of_plant_unit' => $request->size_of_plant_unit,
                'province_id' => $request->province_id,
                'district_id' => $request->district,
                'proposed_connection_point' => $request->proposed_connection_point,
//                'total_system_generated'=> $total,
                'available_capacity' => $request->available_capacity,
                'voltage_level' => $request->voltage_level,
                'date_of_connection' => $request->date_of_connection,
                'expiry_connection_point' => $request->expiry_connection_point,
                'status_of_engagement' => $request->status_of_engagement,
                'updates_on_engagements' => $request->updates_on_engagements,
                'date_of_update' => $request->date_of_update,
                'updated_by' => $request->updated_by,
                'type_of_venture' => $request->type_of_venture,
                'contact_person_name' => $request->contact_person_name,
                'contact_person_email' => $request->contact_person_email,
                'contact_person_phone' => $request->contact_person_phone,
                'preferred_connection_level' => $request->contact_person_phone,
                'ipp_tariff' => $request->ipp_tariff,
            ],


            [
                'system_ref' => $docCount,
                'invoiced_services' => $request->invoiced_services,
                'technology' => $request->technology,
                'engagement_number' => $request->engagement_number,
                'name_of_ipp' => $request->name_of_ipp,
                'date_of_application' => $request->date_of_application,
                'size_of_plant' => $request->size_of_plant,
                'size_of_plant_unit' => $request->size_of_plant_unit,
                'province_id' => $request->province_id,
                'district_id' => $request->district,
                'proposed_connection_point' => $request->proposed_connection_point,
//                'total_system_generated'=> $total,
                'available_capacity' => $request->available_capacity,
                'voltage_level' => $request->voltage_level,
                'date_of_connection' => $request->date_of_connection,
                'expiry_connection_point' => $request->expiry_connection_point,
                'status_of_engagement' => $request->status_of_engagement,
                'updates_on_engagements' => $request->updates_on_engagements,
//                'doc_type' => $request->doc_type,
                'date_of_update' => $request->date_of_update,
                'updated_by' => $request->updated_by,
                'type_of_venture' => $request->type_of_venture,
                'contact_person_name' => $request->contact_person_name,
                'contact_person_email' => $request->contact_person_email,
                'contact_person_phone' => $request->contact_person_phone,

                'preferred_connection_level' => $request->contact_person_phone,
                'ipp_tariff' => $request->ipp_tariff,


            ]);

        if (!empty($files)) {
            if (array_key_exists('doc_type', $files)) {

                $doc_types = $files['doc_type'];

//            dd($doc_types);

                foreach ($doc_types as $file_one) {

                    $filenameWithExt = preg_replace("/[^a-zA-Z]+/", "_", $file_one->getClientOriginalName());
                    // Get just filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    //get size
                    $size = number_format($file_one->getSize() * 0.000001, 2);
                    // Get just ext
                    $extension = $file_one->getClientOriginalExtension();
                    // Filename to store
                    $fileName = trim(preg_replace('/\s+/', ' ', $filename . '_' . time() . '.' . $extension));
                    // Upload File
                    $path = $file_one->storeAs('public/contracts', $fileName);
//                $path = $file_one->storeAs(storage_path('app/public/contracts'), $fileName);
                    $uuid = Str::uuid()->toString();

                    //
                    FileUploads::updateOrCreate(
                        [
                            'uuid' => $uuid,
                            'name' => $fileName,
                            'size' => $size,
                            'path' => $path,
                            'ext' => $file_one->extension(),
                            'folder' => IndependentProducerController::class,
                            'model_id' => $ippcontract->id ?? 1,
                            'modal_code' => $ippcontract->system_ref ?? 1,
                            'type' => 'contracts'

                        ],
                        [
                            'uuid' => $uuid,
                            'name' => $fileName,
                            'size' => $size,
                            'path' => $path,
                            'ext' => $file_one->extension(),
                            'folder' => IndependentProducerController::class,
                            'model_id' => $ippcontract->id ?? 1,
                            'modal_code' => $ippcontract->system_ref ?? 1,
                            'type' => 'contracts'

                        ]
                    );

//                dd(123);

                }

            }

        }

        return redirect()->route('home')
            ->with('message', 'Submitted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(IndependentProducer $item)
    {
        $contracts = FileUploads::where('type', 'contracts')
            ->where('folder', IndependentProducerController::class)
            ->where('model_id', $item->id)
            ->where('modal_code', $item->system_ref)
            ->get();
        return view('independent_producers.show')->with(compact('item', 'contracts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, IndependentProducer $item)
    {

//        dd($item);
        $contracts = FileUploads::where('type', 'contracts')
            ->where('folder', IndependentProducerController::class)
            ->where('model_id', $item->id)
            ->where('modal_code', $item->system_ref)
            ->get();

        $provinces = Province::get();

        $statuses = Status::get();

        return view('independent_producers.edit')->with(compact('item', 'contracts','provinces','statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IndependentProducer $item)
    {


        $validatedData = $request->validate([
            'name_of_ipp' => ['required'],

        ]);


        $item->invoiced_services = $request->invoiced_services;
        $item->technology = $request->technology;
        $item->engagement_number = $request->engagement_number;
        $item->name_of_ipp = $request->name_of_ipp;
        $item->date_of_application = $request->date_of_application;
        $item->size_of_plant = $request->size_of_plant;
        $item->size_of_plant_unit = $request->size_of_plant_unit;
        $item->province_id = $request->province_id;
        $item->district_id = $request->district_id;
        $item->proposed_connection_point = $request->proposed_connection_point;
        $item->available_capacity = $request->available_capacity;
//             $item-> 'effective_date_comment' => $request->effective_date_comment,
        $item->voltage_level = $request->voltage_level;
        $item->date_of_connection = $request->date_of_connection;
        $item->expiry_connection_point = $request->expiry_connection_point;
        $item->status_of_engagement = $request->status_of_engagement;
        $item->updates_on_engagements = $request->updates_on_engagements;
        $item->date_of_update = $request->date_of_update;
        $item->updated_by = $request->updated_by;
        $item->contact_person_name = $request->contact_person_name;
        $item->contact_person_email = $request->contact_person_email;
        $item->contact_person_phone = $request->contact_person_phone;
        $item->type_of_venture = $request->type_of_venture;
        $item->expected_date_commissioning = $request->expected_date_commissioning;
        $item->expected_commercial = $request->expected_commercial;
        $item->preferred_connection_level = $request->contact_person_phone;
        $item->ipp_tariff = $request->ipp_tariff;




//        $item->contact_person_phone = $request->contact_person_phone;
        $item->save();

        return redirect()->route('home')->with('message', 'Contract Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // php artisan storage:link
    }

}
