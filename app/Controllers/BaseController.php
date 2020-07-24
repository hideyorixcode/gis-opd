<?php

namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class HomeController extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use App\Models\BarangModel;
use App\Models\DetailTransaksiModel;
use App\Models\KategoriModel;
use App\Models\KonfigurasiModel;
use App\Models\LabModel;
use App\Models\LogModel;
use App\Models\PenggunaModel;
use App\Models\PetugasLabModel;
use App\Models\TransaksiModel;
use CodeIgniter\Controller;
use Config\Services;

class BaseController extends Controller
{

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['main', 'form', 'url', 'text', 'date'];
    protected $hashids = "";

    /**
     * Constructor.
     */
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
        session();

        $this->db = db_connect();
        $this->reqService = Services::request();
        $this->pagerService = Services::pager();

        $this->mkonfigurasi = new KonfigurasiModel($this->reqService);
        $this->mlog = new LogModel($this->reqService);
        $this->mpengguna = new PenggunaModel($this->reqService);

        $this->form_validation = Services::validation();
        $id_session = session()->get('id');
        $dataGlobal = [
            'logo_web' => getSetting("logo"),
            'judul_aplikasi' => getSetting("judul"),
            'deskripsi_web' => getSetting("deskripsi"),
            'keyword_web' => getSetting("keyword"),
            'email_web' => getSetting("email"),
            'notelepon_web' => getSetting("notelepon"),
            'nama_app' => getSetting("nama_app"),
            'alamat_web' => getSetting("alamat"),
            'author' => getSetting("author"),
            'area' => getSetting("area")
        ];
        if ($id_session) {
            $data_pengguna = $this->mpengguna->select(['username', 'password', 'active', 'id_unker', 'nama_unker', 'singkatan_unker', 'latitude', 'longitude', 'alamat', 'no_telepon', 'email', 'website', 'nip_pejabat', 'nama_pejabat', 'status', 'created_by', 'updated_by', 'logo'])->where('id', decodeHash($id_session))->first();
            if (empty($data_pengguna["logo"])) {
                $img_logo = "user.png";
            } else {
                $img_logo = $data_pengguna["logo"];
            }
            $dataGlobal += [
                'sesi_id' => $id_session,
                'sesi_id_decode' => decodeHash($id_session)[0],
                'sesi_nama_unker' => $data_pengguna['nama_unker'],
                'sesi_singkatan_unker' => $data_pengguna['singkatan_unker'],
                'sesi_username' => $data_pengguna['username'],
                'sesi_latitude' => $data_pengguna['latitude'],
                'sesi_longitude' => $data_pengguna['longitude'],
                'sesi_alamat' => $data_pengguna['alamat'],
                'sesi_no_telepon' => $data_pengguna['no_telepon'],
                'sesi_email' => $data_pengguna['email'],
                'sesi_website' => $data_pengguna['website'],
                'sesi_nip_pejabat' => $data_pengguna['nip_pejabat'],
                'sesi_nama_pejabat' => $data_pengguna['nama_pejabat'],
                'sesi_logo' => $img_logo,
                'sesi_logo_asli' => $data_pengguna["logo"],
                'sesi_status' => $data_pengguna['status'],
                'sesi_active' => $data_pengguna['active'],
            ];
        }

        $this->dataGlobal = $dataGlobal;
    }



}
