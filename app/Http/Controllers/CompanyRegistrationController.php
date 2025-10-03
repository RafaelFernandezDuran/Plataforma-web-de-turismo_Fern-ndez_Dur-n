<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
                return $this->validateStep3($request);
            case 4:
                return $this->validateStep4($request);
            case 5:
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:companies,name',
            'legal_name' => 'required|string|max:255',
            'ruc' => 'required|string|size:11|unique:companies,ruc|regex:/^[0-9]{11}$/',
            'email' => 'required|email|unique:companies,email',
            'phone' => 'required|string|min:7|max:15',
            'emergency_phone' => 'nullable|string|min:7|max:15',
            'website' => 'nullable|url|max:255',
        ], [
            'name.required' => 'El nombre comercial es obligatorio',
            'name.unique' => 'Ya existe una empresa con este nombre',
            'legal_name.required' => 'La razón social es obligatoria',
            'ruc.required' => 'El RUC es obligatorio',
            'ruc.size' => 'El RUC debe tener exactamente 11 dígitos',
            'ruc.unique' => 'Ya existe una empresa registrada con este RUC',
            'ruc.regex' => 'El RUC debe contener solo números',
            'email.required' => 'El email es obligatorio',
            'email.email' => 'Ingresa un email válido',
            'email.unique' => 'Ya existe una empresa con este email',
            'phone.required' => 'El teléfono es obligatorio',
            'website.url' => 'Ingresa una URL válida para el sitio web'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Guardar en sesión para el siguiente paso
        session(['company_registration.step1' => $request->all()]);

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
        $validator = Validator::make($request->all(), [
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'region' => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:10',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'contact_person' => 'required|string|max:255',
            'contact_position' => 'required|string|max:100',
        ], [
            'address.required' => 'La dirección es obligatoria',
            'city.required' => 'La ciudad es obligatoria',
            'region.required' => 'La región es obligatoria',
            'contact_person.required' => 'El nombre del contacto es obligatorio',
            'contact_position.required' => 'El cargo del contacto es obligatorio',
            'latitude.between' => 'La latitud debe estar entre -90 y 90',
            'longitude.between' => 'La longitud debe estar entre -180 y 180'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        session(['company_registration.step2' => $request->all()]);

        return response()->json([
            'success' => true,
            'message' => 'Información de ubicación guardada correctamente',
            'next_step' => 3
        ]);
    }

    /**
     * Paso 3: Información comercial
     */
    private function validateStep3(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string|min:100|max:2000',
            'specialties' => 'required|string|max:1000',
            'services' => 'required|array|min:1',
            'services.*' => 'string|max:100',
            'languages' => 'required|array|min:1',
            'languages.*' => 'string|max:50',
            'founded_year' => 'required|integer|min:1900|max:' . date('Y'),
            'employee_count' => 'required|integer|min:1|max:1000',
            'min_group_size' => 'required|integer|min:1|max:50',
            'max_group_size' => 'required|integer|min:1|max:200|gte:min_group_size',
        ], [
            'description.required' => 'La descripción de la empresa es obligatoria',
            'description.min' => 'La descripción debe tener al menos 100 caracteres',
            'description.max' => 'La descripción no puede exceder 2000 caracteres',
            'specialties.required' => 'Las especialidades son obligatorias',
            'services.required' => 'Debe seleccionar al menos un servicio',
            'languages.required' => 'Debe seleccionar al menos un idioma',
            'founded_year.required' => 'El año de fundación es obligatorio',
            'founded_year.min' => 'El año de fundación no puede ser anterior a 1900',
            'founded_year.max' => 'El año de fundación no puede ser posterior al año actual',
            'employee_count.required' => 'El número de empleados es obligatorio',
            'min_group_size.required' => 'El tamaño mínimo de grupo es obligatorio',
            'max_group_size.required' => 'El tamaño máximo de grupo es obligatorio',
            'max_group_size.gte' => 'El tamaño máximo debe ser mayor o igual al mínimo'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        session(['company_registration.step3' => $request->all()]);

        return response()->json([
            'success' => true,
            'message' => 'Información comercial guardada correctamente',
            'next_step' => 4
        ]);
    }

    /**
     * Paso 4: Documentos y certificaciones
     */
    private function validateStep4(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'business_license' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'tourism_license' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'insurance_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg|max:3072',
            'certifications' => 'nullable|array',
            'certifications.*' => 'string|max:200',
            'awards' => 'nullable|array',
            'awards.*' => 'string|max:200',
        ], [
            'logo.required' => 'El logo de la empresa es obligatorio',
            'logo.image' => 'El logo debe ser una imagen',
            'logo.max' => 'El logo no debe exceder 2MB',
            'business_license.required' => 'La licencia de funcionamiento es obligatoria',
            'business_license.max' => 'La licencia no debe exceder 5MB',
            'tourism_license.max' => 'La licencia turística no debe exceder 5MB',
            'insurance_certificate.max' => 'El certificado de seguro no debe exceder 5MB',
            'gallery.*.image' => 'Las imágenes de galería deben ser archivos de imagen',
            'gallery.*.max' => 'Cada imagen no debe exceder 3MB'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Subir archivos
        $files = [];
        
        // Logo
        if ($request->hasFile('logo')) {
            $files['logo'] = $request->file('logo')->store('companies/logos', 'public');
        }

        // Documentos
        if ($request->hasFile('business_license')) {
            $files['business_license'] = $request->file('business_license')->store('companies/documents', 'public');
        }

        if ($request->hasFile('tourism_license')) {
            $files['tourism_license'] = $request->file('tourism_license')->store('companies/documents', 'public');
        }

        if ($request->hasFile('insurance_certificate')) {
            $files['insurance_certificate'] = $request->file('insurance_certificate')->store('companies/documents', 'public');
        }

        // Galería
        $gallery = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $gallery[] = $file->store('companies/gallery', 'public');
            }
        }
        $files['gallery'] = $gallery;

        session(['company_registration.step4' => array_merge($request->except(['logo', 'business_license', 'tourism_license', 'insurance_certificate', 'gallery']), $files)]);

        return response()->json([
            'success' => true,
            'message' => 'Documentos subidos correctamente',
            'next_step' => 5
        ]);
    }

    /**
     * Paso 5: Finalizar registro
     */
    private function finalizeRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_email' => 'required|email|unique:users,email',
            'user_password' => 'required|string|min:8|confirmed',
            'terms_accepted' => 'required|accepted',
            'privacy_accepted' => 'required|accepted',
        ], [
            'user_email.required' => 'El email del usuario es obligatorio',
            'user_email.email' => 'Ingresa un email válido',
            'user_email.unique' => 'Ya existe un usuario con este email',
            'user_password.required' => 'La contraseña es obligatoria',
            'user_password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'user_password.confirmed' => 'La confirmación de contraseña no coincide',
            'terms_accepted.accepted' => 'Debe aceptar los términos y condiciones',
            'privacy_accepted.accepted' => 'Debe aceptar la política de privacidad'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            // Obtener datos de todos los pasos
            $step1 = session('company_registration.step1', []);
            $step2 = session('company_registration.step2', []);
            $step3 = session('company_registration.step3', []);
            $step4 = session('company_registration.step4', []);

            // Crear usuario
            $user = User::create([
                'name' => $step2['contact_person'],
                'email' => $request->user_email,
                'password' => Hash::make($request->user_password),
                'user_type' => 'company_admin',
            ]);

            // Crear empresa
            $company = Company::create([
                // Paso 1
                'name' => $step1['name'],
                'legal_name' => $step1['legal_name'],
                'ruc' => $step1['ruc'],
                'email' => $step1['email'],
                'phone' => $step1['phone'],
                'emergency_phone' => $step1['emergency_phone'] ?? null,
                'website' => $step1['website'] ?? null,
                
                // Paso 2
                'address' => $step2['address'],
                'city' => $step2['city'],
                'region' => $step2['region'],
                'postal_code' => $step2['postal_code'] ?? null,
                'latitude' => $step2['latitude'] ?? null,
                'longitude' => $step2['longitude'] ?? null,
                'contact_person' => $step2['contact_person'],
                'contact_position' => $step2['contact_position'],
                
                // Paso 3
                'description' => $step3['description'],
                'specialties' => $step3['specialties'],
                'services' => json_encode($step3['services']),
                'languages' => json_encode($step3['languages']),
                'founded_year' => $step3['founded_year'],
                'employee_count' => $step3['employee_count'],
                'min_group_size' => $step3['min_group_size'],
                'max_group_size' => $step3['max_group_size'],
                
                // Paso 4
                'logo' => $step4['logo'] ?? null,
                'gallery' => json_encode($step4['gallery'] ?? []),
                'business_license' => $step4['business_license'] ?? null,
                'tourism_license' => $step4['tourism_license'] ?? null,
                'insurance_certificate' => $step4['insurance_certificate'] ?? null,
                'certifications' => json_encode($step4['certifications'] ?? []),
                'awards' => json_encode($step4['awards'] ?? []),
                
                // Configuración
                'user_id' => $user->id,
                'registration_status' => 'pending',
                'status' => 'inactive',
                'terms_accepted' => true,
                'terms_accepted_at' => now(),
                'submitted_at' => now(),
                'commission_rate' => 10.00, // Rate por defecto
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

    /**
     * Obtener lista de servicios disponibles
     */
    public function getServices()
    {
        $services = [
            'Turismo de Aventura',
            'Ecoturismo',
            'Turismo Rural',
            'Turismo Gastronómico',
            'Turismo Cultural',
            'Turismo de Naturaleza',
            'Deportes Acuáticos',
            'Senderismo y Trekking',
            'Observación de Aves',
            'Fotografía de Naturaleza',
            'Tours Fotográficos',
            'Turismo Vivencial',
            'Aguas Termales',
            'Canopy y Tirolesa',
            'Rafting',
            'Kayak',
            'Pesca Deportiva',
            'Ciclismo de Montaña',
            'Escalada',
            'Camping',
        ];

        return response()->json($services);
    }

    /**
     * Obtener lista de idiomas disponibles
     */
    public function getLanguages()
    {
        $languages = [
            'Español',
            'Inglés',
            'Portugués',
            'Francés',
            'Alemán',
            'Italiano',
            'Japonés',
            'Chino Mandarín',
            'Quechua',
            'Ashaninka',
        ];

        return response()->json($languages);
    }
}
