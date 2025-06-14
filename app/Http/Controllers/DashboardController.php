<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Studio;
use App\Models\Portfolio;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException; // Import ValidationException

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function pelanggan()
    {
        // Mengambil semua user, diurutkan berdasarkan tanggal pembuatan terbaru
        // Anda bisa menambahkan filter jika 'pelanggan' memiliki role spesifik, misalnya:
        // $customers = User::where('role', 'customer')->orderBy('created_at', 'desc')->get();
        $customers = User::orderBy('created_at', 'desc')->get();
        
        return view('admin.pelanggan', compact('customers'));
    }

    public function showPelanggan($id)
    {
        try {
            Log::info('showPelanggan method called with ID: ' . $id);

            // Validasi parameter ID
            if (!is_numeric($id) || $id <= 0) {
                Log::warning('Invalid ID provided to showPelanggan method: ' . $id);
                return response()->json([
                    'success' => false,
                    'message' => 'ID pelanggan tidak valid.'
                ], 400);
            }

            // Menggunakan Eloquent findOrFail untuk mencari pelanggan
            $customer = User::findOrFail($id);

            Log::info('Customer found successfully with ID: ' . $id);

            // Mengembalikan semua atribut model sebagai array JSON
            return response()->json([
                'success' => true,
                'data' => $customer->toArray()
            ]);

        } catch (ModelNotFoundException $e) {
            Log::error('Customer not found in showPelanggan method for ID ' . $id . ': ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Pelanggan dengan ID tersebut tidak ditemukan.'
            ], 404);
        } catch (\Exception $e) {
            Log::error('General error in showPelanggan method for ID ' . $id . ': ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server saat memuat data pelanggan.'
            ], 500);
        }
    }

    /**
     * Memperbarui data pelanggan yang ada.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePelanggan(Request $request, $id)
    {
        try {
            // Validasi data yang masuk
            $validatedData = $request->validate([
                'nama_lengkap' => 'required|string|max:255',
                'nama_pengguna' => 'required|string|max:255|unique:users,nama_pengguna,' . $id, // Unique kecuali ID ini
                'email' => 'required|string|email|max:255|unique:users,email,' . $id, // Unique kecuali ID ini
                'telepon' => 'nullable|string|max:20', // Telepon bisa null atau string
            ]);

            // Temukan pelanggan berdasarkan ID
            $customer = User::findOrFail($id);

            // Perbarui data pelanggan
            $customer->update($validatedData);

            Log::info('Customer updated successfully: ' . $customer->id);

            return response()->json([
                'success' => true,
                'message' => 'Data pelanggan berhasil diperbarui!',
                'data' => $customer->toArray()
            ], 200);

        } catch (ValidationException $e) {
            Log::warning('Validation failed for updatePelanggan ID ' . $id . ': ' . json_encode($e->errors()));
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid.',
                'errors' => $e->errors()
            ], 422);
        } catch (ModelNotFoundException $e) {
            Log::error('Customer not found for updatePelanggan with ID: ' . $id);
            return response()->json([
                'success' => false,
                'message' => 'Pelanggan dengan ID tersebut tidak ditemukan.'
            ], 404);
        } catch (\Exception $e) {
            Log::error('General error in updatePelanggan method for ID ' . $id . ': ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            $errorMessage = 'Gagal memperbarui data pelanggan.';
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
     * Menghapus data pelanggan.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deletePelanggan($id)
    {
        try {
            // Temukan pelanggan berdasarkan ID
            $customer = User::findOrFail($id);

            // Hapus pelanggan
            $customer->delete();

            Log::info('Customer deleted successfully: ' . $id);

            return response()->json([
                'success' => true,
                'message' => 'Pelanggan berhasil dihapus.'
            ], 200);

        } catch (ModelNotFoundException $e) {
            Log::error('Customer not found for deletePelanggan with ID: ' . $id);
            return response()->json([
                'success' => false,
                'message' => 'Pelanggan dengan ID tersebut tidak ditemukan.'
            ], 404);
        } catch (\Exception $e) {
            Log::error('General error in deletePelanggan method for ID ' . $id . ': ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            $errorMessage = 'Gagal menghapus pelanggan.';
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

    public function pengaturan()
    {
       $portfolios = Portfolio::orderBy('created_at', 'desc')->get();
        // You would typically pass this to your Blade view
        return view('admin.pengaturan', compact('portfolios'));
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
                'kapasitas' => 'required|numeric|max:20',
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
                'kapasitas' => 'required|numeric|max:20',
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