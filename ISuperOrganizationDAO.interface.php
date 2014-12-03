<?php

require_once(dirname(__FILE__).'/ISuperOrganization.interface.php');

/**
 * interface ISuperOrganizationDAO
 *
 * superorganizationテーブルのData Access Objectのインターフェイス(API定義)
 *
 * @author : TOIDA Yuto 2014/11/19
*/

interface ISuperOrganizationDAO
{

	/**
	 * コンストラクタ ISuperOrganizatinDAOインターフェイスを実装したクラスのオブジェクトを初期化する
	 * コンストラクタは引数の&$PDOObjectを変更しないように実装される
	 *
	 * @param PDO &$PDOObject superorganizationテーブルの存在するデータベースへアクセス可能なPDOオブジェクト
	 */
	public function __construct(&$PDOObject);
	
	/**
	 * レコードIDを指定してISuperOrganizationインターフェイスを実装したクラスのオブジェクトを取得する
	 *
	 * @param int $id SELECTする際に使用するsuperorganization_id
	 * @return ISuperOrganization $idに対応するレコード
	 */
	public function selectSuperOrganizationById($id);

	/**
	 * superorganizationテーブルに存在する全てのレコードを取得する
	 *
	 * @return array superorganizationテーブルの全レコードをISuperOrganizationインターフェイスを実装したクラスのオブジェクト配列で返す
	 */
	public function selectAllSuperOrganizations();

	/**
	 * ISuperOrganizationオブジェクトをデータベースにINSERTする
	 *
	 * @param ISuperOrganization &$superOrganization データベースにINSERTするデータを入力したISuperOrganizationオブジェクト idの値は無視される
	 */
	public function insertSuperOrganization(&$superOrganization);

	/**
	 * 引数のISsuperOrganizationオブジェクトのIDを持ったレコードを引数のその他の値でUPDATEする
	 * &$superOrganizationオブジェクトは変更されないように実装される
	 *
	 * @param ISuperOrganization &$superOrganization UPDATEするデータを入力したISuperOrganizationオブジェクト
	 */
	public function updateSuperOrganization(&$superOrganization);

	/**
	 * IDで指定したレコードをDELETEする
	 *
	 * @param int $id DELETEするレコードのid
	 */
	public function deleteSuperOrganizationById($id);

	/**
	 * 引数と全ての値が同じレコードをDELETEする
	 * &$superOrganizationオブジェクトは変更されないように実装される
	 *
	 * @param ISuperOrganization &$superOrganization DELETEするレコードと一致するISuperOrganizationオブジェクト
	 */
	public function deleteSuperOrganizationByInstance(&$superOrganization);
};
