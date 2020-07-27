<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class PenggunaModel extends Model
{
    protected $table = "unitkerja";
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'active', 'id_unker', 'nama_unker', 'singkatan_unker', 'latitude', 'longitude', 'alamat', 'no_telepon', 'email', 'website', 'nip_pejabat', 'nama_pejabat', 'status', 'logo', 'created_by', 'updated_by'];

    protected $column_order = array(null, 'nama_unker', 'username', 'nama_pejabat', 'alamat', 'no_telepon', 'email', 'website');
    protected $column_search = array('nama_unker', 'nama_pejabat', 'username', 'singkatan_unker', 'alamat');
    protected $order = array('id_unker' => 'asc');
    protected $order_rekap = array('status' => 'asc');

    protected $column_order_uptd = array(null, 'nama_unker', 'username', 'nama_pejabat', 'alamat', 'status', 'email', 'website');

    protected $request;
    protected $db;
    protected $dt;
    //protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    function __construct(RequestInterface $request)
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        $this->dt = $this->db->table($this->table);
    }


    function get_datatables_opd()
    {
        $this->_get_datatables_query_opd();
        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }

    private function _get_datatables_query_opd()
    {
        $this->dt->where('status', 'OPD');
        $kabkota = $this->request->getPost('kabupaten_kota');
        if ($kabkota != "") {
            if ($kabkota == "all") {

            }
            else
            {
                $this->dt->groupStart();
                $this->dt->like('alamat', $kabkota);
                $this->dt->groupEnd();
            }
        } else {
            $this->dt->where('alamat', '');
        }
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($this->request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $this->request->getPost('search')['value']);
                } else {
                    $this->dt->orLike($item, $this->request->getPost('search')['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        if ($this->request->getPost('order')) {
            $this->dt->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }

    function count_filtered_opd()
    {
        $this->_get_datatables_query_opd();
        return $this->dt->countAllResults();
    }
    
    public function count_all_opd_aja()
    {
        //   $tbl_storage = $this->db->table($this->table);
        $this->dt->where('status', 'OPD');
        return $this->dt->countAllResults();
    }

    public function count_all_opd()
    {
        //   $tbl_storage = $this->db->table($this->table);
        $this->dt->where('status', 'OPD');
        $kabkota = $this->request->getPost('kabupaten_kota');
        if ($kabkota != "") {
            if ($kabkota == "all") {

            }
            else
            {
                $this->dt->groupStart();
                $this->dt->like('alamat', $kabkota);
                $this->dt->groupEnd();
            }
        } else {
            $this->dt->where('alamat', '');
        }
        return $this->dt->countAllResults();
    }

    public function count_all_uptd_aja($id_unker)
    {
        //   $tbl_storage = $this->db->table($this->table);
        if ($id_unker != '') {
            $this->dt->groupStart();
            $this->dt->like('id_unker', $id_unker);
            $this->dt->groupEnd();
        }
        $this->dt->where('status', 'UPTD');
        return $this->dt->countAllResults();
    }

    public function count_all_cabdin_aja($id_unker)
    {
        //   $tbl_storage = $this->db->table($this->table);
        if ($id_unker != '') {
            $this->dt->groupStart();
            $this->dt->like('id_unker', $id_unker);
            $this->dt->groupEnd();
        }
        $this->dt->where('status', 'CABDIN');
        return $this->dt->countAllResults();
    }

    public function count_all_uptd_aja($id_unker)
    {
        //   $tbl_storage = $this->db->table($this->table);
        if($id_unker!='')
        {
            $this->dt->groupStart();
            $this->dt->like('id_unker', $id_unker);
            $this->dt->groupEnd();
        }
        $this->dt->where('status', 'UPTD');
        return $this->dt->countAllResults();
    }

    public function count_all_cabdin_aja($id_unker)
    {
        //   $tbl_storage = $this->db->table($this->table);
        if($id_unker!='')
        {
            $this->dt->groupStart();
            $this->dt->like('id_unker', $id_unker);
            $this->dt->groupEnd();
        }
        $this->dt->where('status', 'CABDIN');
        return $this->dt->countAllResults();
    }

    function get_datatables_uptd()
    {
        $this->_get_datatables_query_uptd();
        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }

    private function _get_datatables_query_uptd()
    {
        $whereIn = ['UPTD', 'CABDIN'];
        $this->dt->whereIn('status', $whereIn);

        $statusPost = $this->request->getPost('statusPost');
        if ($statusPost != "") {
            $this->dt->where('status', $statusPost);
        }
        $id_unker_opd = $this->request->getPost('id_unker_opd');
        if ($id_unker_opd != "") {
            $this->dt->groupStart();
            $this->dt->like('id_unker', $id_unker_opd);
            $this->dt->groupEnd();
        }

        $kabkota = $this->request->getPost('kabupaten_kota');
        if ($kabkota != "") {
            if ($kabkota == "all") {

            }
            else
            {
                $this->dt->groupStart();
                $this->dt->like('alamat', $kabkota);
                $this->dt->groupEnd();
            }
        } else {
            $this->dt->where('alamat', '');
        }

        $i = 0;
        foreach ($this->column_search as $item) {
            if ($this->request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $this->request->getPost('search')['value']);
                } else {
                    $this->dt->orLike($item, $this->request->getPost('search')['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        if ($this->request->getPost('order')) {
            $this->dt->orderBy($this->column_order_uptd[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }

    function count_filtered_uptd()
    {
        $this->_get_datatables_query_uptd();
        return $this->dt->countAllResults();
    }

    public function count_all_uptd()
    {
        //   $tbl_storage = $this->db->table($this->table);
        $whereIn = ['UPTD', 'CABDIN'];
        $this->dt->whereIn('status', $whereIn);
        $statusPost = $this->request->getPost('statusPost');
        if ($statusPost != "") {
            $this->dt->where('status', $statusPost);
        }
        $id_unker_opd = $this->request->getPost('id_unker_opd');
        if ($id_unker_opd != "") {
            $this->dt->groupStart();
            $this->dt->like('id_unker', $id_unker_opd);
            $this->dt->groupEnd();
        }
        $kabkota = $this->request->getPost('kabupaten_kota');
        if ($kabkota != "") {
            if ($kabkota == "all") {

            }
            else
            {
                $this->dt->groupStart();
                $this->dt->like('alamat', $kabkota);
                $this->dt->groupEnd();
            }
        } else {
            $this->dt->where('alamat', '');
        }
        return $this->dt->countAllResults();
    }

    function get_datatables_rekap()
    {
        $this->_get_datatables_query_rekap();
        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }

    private function _get_datatables_query_rekap()
    {
        $whereIn = ['UPTD', 'CABDIN', 'OPD'];
        $this->dt->whereIn('status', $whereIn);

        $statusPost = $this->request->getPost('statusPost');
        if ($statusPost != "") {
            $this->dt->where('status', $statusPost);
        }


        $kabkota = $this->request->getPost('kabupaten_kota');
        if ($kabkota != "") {
            if ($kabkota == "all") {

            }
            else
            {
                $this->dt->groupStart();
                $this->dt->like('alamat', $kabkota);
                $this->dt->groupEnd();
            }
        } else {
            $this->dt->where('alamat', '');
        }

        $i = 0;
        foreach ($this->column_search as $item) {
            if ($this->request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $this->request->getPost('search')['value']);
                } else {
                    $this->dt->orLike($item, $this->request->getPost('search')['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        if ($this->request->getPost('order')) {
            $this->dt->orderBy($this->column_order_uptd[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } else if (isset($this->order_rekap)) {
            $order = $this->order_rekap;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }

    function count_filtered_rekap()
    {
        $this->_get_datatables_query_uptd();
        return $this->dt->countAllResults();
    }

    public function count_all_rekap()
    {
        //   $tbl_storage = $this->db->table($this->table);
        $whereIn = ['UPTD', 'CABDIN', 'OPD'];
        $this->dt->whereIn('status', $whereIn);
        $statusPost = $this->request->getPost('statusPost');
        if ($statusPost != "") {
            $this->dt->where('status', $statusPost);
        }

        $kabkota = $this->request->getPost('kabupaten_kota');
        if ($kabkota != "") {
            if ($kabkota == "all") {

            }
            else
            {
                $this->dt->groupStart();
                $this->dt->like('alamat', $kabkota);
                $this->dt->groupEnd();
            }
        } else {
            $this->dt->where('alamat', '');
        }
        return $this->dt->countAllResults();
    }

    function read_by_id($id)
    {
        $data = $this->dt->select('username', 'password', 'active', 'id_unker', 'nama_unker', 'singkatan_unker', 'latitude', 'longitude', 'alamat', 'no_telepon', 'email', 'website', 'nip_pejabat', 'nama_pejabat', 'status', 'logo')->where($this->primaryKey, $id)->first();
        return $data;
    }

}