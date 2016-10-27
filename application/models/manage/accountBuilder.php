<?php 

class AccountBuilder{
	
	protected  $_account = NULL;
	protected  $_configs = array();
	
	public function __construct( $configs = array() ){
		$this->_configs   = $configs;
		$this->_account   = new Member_account_entity();
	}
	
	public function build(){
		$this->_account->setMember_id(               $this->_configs['member_id']               );
		$this->_account->setMember_name(             $this->_configs['member_name']             );
		$this->_account->setMember_qq(               $this->_configs['member_qq']               );
		$this->_account->setMember_qq2(              $this->_configs['member_qq2']              );
		$this->_account->setMember_qq_addfriend(     $this->_configs['member_qq_addfriend']     );
		$this->_account->setMember_qq2_addfriend(    $this->_configs['member_qq2_addfriend']    );
		$this->_account->setMember_phone(            $this->_configs['member_phone']            );
		$this->_account->setMember_phone2(           $this->_configs['member_phone2']           );
		$this->_account->setMember_weixin(           $this->_configs['member_weixin']           );
		$this->_account->setMember_weixin_addfriend( $this->_configs['member_weixin_addfriend'] );
		$this->_account->setMember_status(           $this->_configs['member_status']           );
		$this->_account->setMember_from(             $this->_configs['member_from']             );
		$this->_account->setCall_start_time(         $this->_configs['call_start_time']         );
		$this->_account->setWen_order_time(          $this->_configs['wen_order_time']          );
		$this->_account->setMember_info(             $this->_configs['member_info']             );
		$this->_account->setMember_habit(            $this->_configs['member_habit']            );
		$this->_account->setIs_upgrade(              $this->_configs['is_upgrade']              );
		$this->_account->setIs_operation(            $this->_configs['is_operation']            );
		$this->_account->setRe_MGM(                  $this->_configs['re_MGM']                  );
		$this->_account->setIs_income(               $this->_configs['is_income']               );
		$this->_account->setKey_reser_time(          $this->_configs['key_reser_time']          );
		$this->_account->setMember_tradehabit(       $this->_configs['member_tradehabit']       );
		$this->_account->setExpert_qq_invited(       $this->_configs['expert_qq_invited']       );
		$this->_account->setExpert_qq_added(         $this->_configs['expert_qq_added']         );
	}
	
	public function getConfigs() {
		return $this->_configs;
	}
	
	public function getAccount(){
		return $this->_account;
	}
	
}

?>