<?php if (!defined('BASEPATH')) exit('No direct access allowed.');



/*---------------------------------------------------------------------------------
 *
 * $increm              自动递增ID
 * $total               查询总条数
 *
 * $parame  			查询参数  数组KEY特殊含义
 *  page             	当前页
 *  limit            	每页条数
 *  desc|asc         	排列顺序
 *  offset           	偏移量
 *  all              	查询所有
 *  like           	    模糊查询
 *
-------------------------------------------------------------------------------------*/



class  MY_Model  extends  CI_Model
{
	
	
	
	protected $table = NULL;
	protected $increm = NULL;
	protected $limit = NULL;
	protected $sorta = NULL;
	protected $sortf = NULL;
	
	
	private $select = NULL;
	private $total = NULL;
	private $sums = NULL;
	
	
	
	
	public function __construct()
	{
		
		parent::__construct();
		
		if(empty($this->limit))
		{
			$this->limit = 20;
		}
		
		if(empty($this->increm))
		{
			$this->increm = 'id';
		}
		if(empty($this->sorta))
		{
			$this->sorta = 'desc';
		}

	}
	
	
	
	public function get_table()
	{
		return $this->table;
	}
	
	
	public function get_increm()
	{
		return $this->increm;
	}
	
		
	
	public function get_list($parame=array(),$page=0,$limit=0)
	{
		$this->select = FALSE;
		$this->total = FALSE;
		$this->sums = FALSE;
		$query = $this->get_query($parame,$page,$limit);
		return $query->result_array();
	}
		
	
	public function get_select($parame=array())
	{
		$this->select = TRUE;
		$this->total = FALSE;
		$this->sums = FALSE;
		$query = $this->get_query($parame);
		return $query->result_array();
	}
	
	
	public function get_row($parame=array())
	{
		$this->select = FALSE;
		$this->total = FALSE;
		$this->sums = FALSE;
		$query = $this->get_query($parame,0,1);
		return $query->row_array();
	}

	
	
	public function get_sum($parame=array())
	{
		$this->sums = TRUE;
		$this->select = FALSE;
		$this->total = FALSE;
		$query = $this->get_query($parame);
		return $query->row_array();
	}
	
	
	public function get_total($parame=array())
	{
		$this->total = TRUE;
		$this->select = FALSE;
		$this->sums = FALSE;
		$query = $this->get_query($parame);
		return $query->num_rows();
	}
	
	
	
	protected function get_query($parame,$page=0,$limit=0)
	{
		if($this->table)
		{
			$this->db->from($this->table.' a');
		}
		
		if( is_null($parame) == FALSE )
		{
			if( is_string($parame) || is_int($parame))
			{
				$this->db->where('a.'.$this->increm,$parame);
			}
			elseif(is_array( $parame ))
			{
				foreach($parame as $key => $value)
				{
					if(is_array($value))
					{
						if($value)
						{
							if(strtolower($key)=='sum')
							{
								foreach($value as $val)
								{	
									$this->db->select_sum('a.'.$val);
								}
							}
							else
							{
								$this->db->where_in('a.'.$key,$value);
							}
						}
					}
					else
					{
						if(strtolower($key)=='sum')
						{
							$this->db->select_sum('a.'.$value);
						}
						elseif(strtolower($key)=='select')
						{
							$this->db->select('a.'.$value);
						}
						elseif(strtolower($key)=='offset')
						{
							$offset = $value;
						}
						elseif(strtolower($key)=='desc')
						{
							$this->db->order_by('a.'.$value,$key);	
						}
						elseif(strtolower($key)=='asc')
						{
							$this->db->order_by('a.'.$value,$key);	
						}
						elseif(strtolower($value)=='all')
						{
							
						}
						else
						{
							$keys = explode(' ',$key);
							
							if(count($keys)==2 && strtolower($keys[1])=='like')
							{
								$this->db->like($keys[0],$value);
							}
							else
							{
								$this->db->where('a.'.$key,$value);
							}
						}	
					}	
				}
			}
		}
		if($page>0)
		{
			if($limit==0)
			{
				$limit = $this->limit;
			}
			if(isset($offset))
			{
				$this->db->limit($limit,abs($page-1)*$limit+$offset);
			}
			else
			{	
				$this->db->limit($limit,abs($page-1)*$limit);
			}
		}
		else
		{
			if($limit>0)
			{
				if(isset($offset))
				{
					$this->db->limit($limit,$offset);
				}
				else
				{
					$this->db->limit($limit);
				}
			}
		}

		if($this->select)
		{
			if(empty($parame['select']))
			{
				$this->db->select('a.'.$this->increm);
			}
		}
		elseif($this->total)
		{	
			if(empty($parame['select']))
			{
				$this->db->select('a.'.$this->increm);
			}
		}
		elseif($this->sums)
		{
			if(empty($parame['sum']))
			{
				$this->db->select_sum('a.'.$this->increm);
			}
		}
		else
		{
			$this->db->select('a.*');
		}

		
		if(empty($parame['desc']) && empty($parame['asc']))
		{
			if($this->sortf)
			{
				$this->db->order_by('a.'.$this->sortf,$this->sorta);
			}
			else{
				$this->db->order_by('a.'.$this->increm,$this->sorta);
			}
		}
		
		return $this->db->get();
		
	}
	
	
	
	
	public function save($parame=array(),$data=array())
	{
		
		if(is_array($parame))
		{
			return $this->db->update($this->table,$data,$parame);
		}
		elseif($parame>0)
		{
			return $this->db->update($this->table,$data,array($this->increm=>$parame)); 
		}
		else
		{
			return $this->db->insert($this->table,$data); 
		}
		
	}
	
	
	
	
	
	public function delete($parame=array())
	{
		
		$symbol = '_';

		if(is_array($parame))
		{
			foreach($parame as $key=>$value)
			{

				if(strpos($value,$symbol)===FALSE)
				{
					$this->db->where($key, $value);
				}
				else
				{
					$list = explode($symbol,$value);
					$this->db->where_in($key,$list);
				}
			}
			return $this->db->delete($this->table);
		}
		else
		{
			return $this->db->delete($this->table,array($this->increm=>$parame));
		}
		
	}

}





