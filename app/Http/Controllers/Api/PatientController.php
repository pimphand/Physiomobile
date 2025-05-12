<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use Illuminate\Support\Arr;
use App\Http\Resources\PatientResource;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    /**
     * Display a listing of all patients with their associated user data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $query = Patient::with('user')
            ->search($request->search);

        $perPage = $request->get('per_page', 10);
        $patients = $query->paginate($perPage);

        return PatientResource::collection($patients);
    }

    /**
     * Store a newly created patient and user in the database.
     *
     * @param  \App\Http\Requests\StorePatientRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePatientRequest $request)
    {
        try {
            DB::beginTransaction();

            // Get all validated data
            $validated = $request->validated();

            // Create a new user record with all validated fields except medium_acquisition
            $user = User::create(Arr::except($validated, ['medium_acquisition']));

            // Create a new patient linked to the user
            $patient = $user->patient()->create([
                'medium_acquisition' => $validated['medium_acquisition'],
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Patient created successfully',
                'data' => new PatientResource($patient->load('user'))
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error creating patient',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified patient with related user information.
     *
     * @param  \App\Models\Patient  $patient
     * @return \App\Http\Resources\PatientResource
     */
    public function show(Patient $patient)
    {
        return new PatientResource($patient->load('user'));
    }

    /**
     * Update the specified patient and associated user in the database.
     *
     * @param  \App\Http\Requests\UpdatePatientRequest  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        try {
            DB::beginTransaction();

            // Update the user data associated with the patient
            $patient->user->update(Arr::except($request->validated(), ['medium_acquisition']));

            // Update the patient-specific data
            $patient->update([
                'medium_acquisition' => $request->validated('medium_acquisition'),
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Patient updated successfully',
                'data' => new PatientResource($patient->load('user'))
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Error updating patient',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified patient and the associated user from the database.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Patient $patient)
    {
        try {
            DB::beginTransaction();

            // Delete the associated user first
            $patient->user->delete();

            // Then delete the patient record
            $patient->delete();

            DB::commit();

            return response()->json(['message' => 'Patient deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Error deleting patient',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
