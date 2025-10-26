<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyStepOneRequest;
use App\Http\Requests\CompanyStepThreeRequest;
use App\Http\Requests\CompanyStepTwoRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class CompanyRegistrationController extends Controller
{
    /**
     * Mostrar el formulario de registro de empresa
     */
    public function showRegistrationForm()
    {
        return view('company.register');
    }

    /**
     * Procesar el registro de empresa (multi-step)
     */
    public function register(Request $request)
    {
        $step = $request->input('step', 1);
        
        switch ($step) {
            case 1:
                return $this->validateStep1($request);
            case 2:
                return $this->validateStep2($request);
            case 3:
                return $this->finalizeRegistration($request);
            default:
                return response()->json(['error' => 'Paso inválido'], 400);
        }
    }

    /**
     * Paso 1: Información básica de la empresa
     */
    private function validateStep1(Request $request)
    {
        $validated = $this->validateWithFormRequest($request, CompanyStepOneRequest::class);

        session(['company_registration.step1' => $validated]);

        return response()->json([
            'success' => true,
            'message' => 'Información básica guardada correctamente',
            'next_step' => 2
        ]);
    }

    /**
     * Paso 2: Ubicación y contacto
     */
    private function validateStep2(Request $request)
    {
        $validated = $this->validateWithFormRequest($request, CompanyStepTwoRequest::class);

        session(['company_registration.step2' => $validated]);

        return response()->json([
            'success' => true,
            'message' => 'Información guardada correctamente',
            'next_step' => 3
        ]);
    }

    /**
     * Paso 3: Finalizar registro
     */
    private function finalizeRegistration(Request $request)
    {
        $validated = $this->validateWithFormRequest($request, CompanyStepThreeRequest::class);

        try {
            DB::beginTransaction();

            // Obtener datos de todos los pasos
            $step1 = session('company_registration.step1', []);
            $step2 = session('company_registration.step2', []);

            // Crear usuario
            $user = User::create([
                'name' => $step2['contact_person'] ?? $step1['name'],
                'email' => $validated['user_email'],
                'password' => Hash::make($validated['user_password']),
                'user_type' => 'company_admin',
            ]);

            // Crear empresa
            $company = Company::create([
                'name' => $step1['name'],
                'ruc' => $step1['ruc'],
                'email' => $step1['email'],
                'phone' => $step1['phone'],
                'address' => $step2['address'],
                'city' => $step2['city'],
                'region' => $step2['region'],
                'contact_person' => $step2['contact_person'],
                'description' => $step2['description'],
                'user_id' => $user->id,
                'registration_status' => 'pending',
                'status' => 'inactive',
                'terms_accepted' => true,
                'terms_accepted_at' => now(),
                'submitted_at' => now(),
                'commission_rate' => 10.00,
            ]);

            DB::commit();

            // Limpiar sesión
            session()->forget('company_registration');

            // Auto login del usuario
            Auth::login($user);

            return response()->json([
                'success' => true,
                'message' => 'Registro completado exitosamente. Tu empresa está siendo revisada.',
                'redirect' => route('company.dashboard')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Error al procesar el registro: ' . $e->getMessage()
            ], 500);
        }
    }

    private function validateWithFormRequest(Request $request, string $formRequestClass): array
    {
        /** @var FormRequest $formRequest */
        $formRequest = $formRequestClass::createFromBase($request);
        $formRequest->setContainer(app());
        $formRequest->setRedirector(app('redirect'));
        $formRequest->setRouteResolver($request->getRouteResolver());
        $formRequest->setUserResolver($request->getUserResolver());
        if (method_exists($request, 'getSession')) {
            $formRequest->setSession($request->getSession());
        }

        $formRequest->validateResolved();

        return $formRequest->validated();
    }

    /**
     * Obtener datos de un paso específico desde la sesión
     */
    public function getStepData(Request $request, $step)
    {
        $stepData = session("company_registration.step{$step}", []);
        
        return response()->json([
            'success' => true,
            'data' => $stepData
        ]);
    }

    /**
     * Validar disponibilidad de nombre o RUC en tiempo real
     */
    public function checkAvailability(Request $request)
    {
        $field = $request->input('field');
        $value = $request->input('value');
        
        if (!in_array($field, ['name', 'ruc', 'email'])) {
            return response()->json(['available' => false]);
        }
        
        $exists = Company::where($field, $value)->exists();
        
        return response()->json(['available' => !$exists]);
    }

}
