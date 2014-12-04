<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Node_M extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    /**
     * 获取nodes
     * @return  关联数组
     */
    public function get_nodes($where = NULL)
    {
        if ($where!=NULL) {
            $this->db->where($where);
        }

        $query = $this->db->get('letsbbs_node');
        $this->db->order_by('nid','desc');
        $nodes = $query->result_array();

        //变为父节点id为第一个参数的数组
        if ($nodes) {
            foreach ($nodes as $node) {
                $newnodes[$node['pid']][]=$node;
            }
            return $newnodes;
        }
    }

    /**
     * 根据nid获取node信息
     * @param   $nid node的id
     * @return       关联数组
     */
    public function get_node_byid($nid)
    {
        $this->db->where('nid', $nid);
        $query = $this->db->get('letsbbs_node');
        return $user_info = $query->row_array();
    }

    /**
     * 添加节点
     * @param  $data 关联数组
     */
    public function add($data)
    {
        return $this->db->insert('letsbbs_node', $data);
    }

    /**
     * 更新节点资料
     * @param   $nid  节点id
     * @param   $data 关联数组 节点资料
     * @return  操作结果
     */
    public function update($nid, $data)
    {
        $this->db->where('nid', $nid);
        return $this->db->update('letsbbs_node', $data);
    }
}

/* End of file node_m.php */
/* Location: ./application/models/node_m.php */