<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function pelanggan()
    {
        return view('admin.pelanggan');
    }

    public function pengaturan()
    {
        return view('admin.pengaturan');
    }

    public function ulasan()
    {
        return view('admin.ulasan');
    }

    public function studio()
    {
        // Menggunakan Eloquent untuk mengambil semua studio
        $studios = Studio::orderBy('dibuat_pada', 'desc')->get();
        return view('admin.studio', compact('studios'));
    }

    /**
     * Menampilkan detail satu studio berdasarkan ID.
     * Digunakan untuk operasi 'ubah' via AJAX.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            Log::info('Studio show method called with ID: ' . $id);

            // Validasi parameter ID
            if (!is_numeric($id) || $id <= 0) {
                Log::warning('Invalid ID provided to show method: ' . $id);
                return response()->json([
                    'success' => false,
                    'message' => 'ID studio tidak valid.'
                ], 400);
            }

            $studio = Studio::find($id);

            if (!$studio) {
                Log::info('Studio not found with ID: ' . $id);
                return response()->json([
                    'success' => false,
                    'message' => 'Studio dengan ID tersebut tidak ditemukan.'
                ], 404);
            }

            Log::info('Studio found successfully with ID: ' . $id);

            return response()->json([
                'success' => true,
                'data' => $studio->toArray()
            ]);

        } catch (\Exception $e) {
            Log::error('Error in Studio show method for ID ' . $id . ': ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server saat memuat data studio.'
            ], 500);
        }
    }


    /**
     * Method untuk menyimpan studio baru.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeStudio(Request $request)
    {
        try {
            // Validasi data
            $validatedData = $request->validate([
                'jenis_studio' => 'required|string|max:100',
                'nama_studio' => 'required|string|max:100',
                'harga' => 'required|numeric|min:0',
                'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Validation failed for storeStudio: ' . json_encode($e->errors()));
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $e->errors()
            ], 422);
        }

        $path = null; 
        $studio = null; 

        DB::beginTransaction();

        try {
            // Handle file upload
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');

                if (!$file->isValid()) {
                    throw new \Exception('File upload tidak valid.');
                }

                $fileName = Str::slug($validatedData['nama_studio']) . '-' . time() . '.' . $file->extension();
                $path = $file->storeAs('studio_images', $fileName, 'public');

                if (!$path) {
                    throw new \Exception('Gagal menyimpan file gambar.');
                }

                $validatedData['gambar'] = $path;
            }

            $studio = Studio::create($validatedData);

            if (!$studio) {
                throw new \Exception('Gagal membuat record studio di database.');
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data studio berhasil disimpan.',
                'data' => $studio->toArray()
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack(); 
            Log::error('Error storing studio: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except('gambar')
            ]);

            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
                Log::info('Deleted partially uploaded image: ' . $path);
            }

            $errorMessage = 'Gagal menyimpan data studio.';
            if (config('app.debug')) {
                $errorMessage .= ' Detail: ' . $e->getMessage();
            }

            return response()->json([
                'success' => false,
                'message' => $errorMessage,
                'error_detail' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Method untuk mengupdate studio.
     * Mengembalikan JSON response.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStudio(Request $request, $id)
    {
        try {
            $studio = Studio::findOrFail($id);

            $validatedData = $request->validate([
                'jenis_studio' => 'required|string|max:100',
                'nama_studio' => 'required|string|max:100',
                'harga' => 'required|numeric|min:0',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            DB::beginTransaction();

            if ($request->hasFile('gambar')) {
                if ($studio->gambar && Storage::disk('public')->exists($studio->gambar)) {
                    Storage::disk('public')->delete($studio->gambar);
                    Log::info('Deleted old image for studio ID ' . $id . ': ' . $studio->gambar);
                }

                $file = $request->file('gambar');
                $fileName = Str::slug($validatedData['nama_studio']) . '-' . time() . '.' . $file->extension();
                $path = $file->storeAs('studio_images', $fileName, 'public');

                if (!$path) {
                    throw new \Exception('Gagal menyimpan file gambar baru.');
                }
                $validatedData['gambar'] = $path;
            }

            // Update record studio
            $studio->update($validatedData);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Studio berhasil diperbarui!',
                'data' => $studio->toArray()
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Validation failed for updateStudio ID ' . $id . ': ' . json_encode($e->errors()));
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Studio not found for update with ID: ' . $id);
            return response()->json([
                'success' => false,
                'message' => 'Studio dengan ID tersebut tidak ditemukan.'
            ], 404);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating studio ID ' . $id . ': ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except('gambar')
            ]);

            $errorMessage = 'Gagal memperbarui data studio.';
            if (config('app.debug')) {
                $errorMessage .= ' Detail: ' . $e->getMessage();
            }

            return response()->json([
                'success' => false,
                'message' => $errorMessage,
                'error_detail' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }


    /**
     * Method untuk menghapus studio.
     * Mengembalikan JSON response.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteStudio($id)
    {
        try {
            $studio = Studio::findOrFail($id);

            DB::beginTransaction();

            // Hapus file gambar jika ada
            if ($studio->gambar && Storage::disk('public')->exists($studio->gambar)) {
                Storage::disk('public')->delete($studio->gambar);
                Log::info('Deleted image for studio ID ' . $id . ': ' . $studio->gambar);
            }

            $studio->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Studio berhasil dihapus.'
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Studio not found for deletion with ID: ' . $id);
            return response()->json([
                'success' => false,
                'message' => 'Studio dengan ID tersebut tidak ditemukan.'
            ], 404);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting studio ID ' . $id . ': ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            $errorMessage = 'Gagal menghapus studio.';
            if (config('app.debug')) {
                $errorMessage .= ' Detail: ' . $e->getMessage();
            }

            return response()->json([
                'success' => false,
                'message' => $errorMessage,
                'error_detail' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
}