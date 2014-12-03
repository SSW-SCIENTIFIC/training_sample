<?php

/**
 * interface ISuperOrganization
 *
 * superorganizationテーブルのData Transfer Objectのインターフェイス(API定義)
 *
 * @author : TOIDA Yuto 2014/11/19
*/

interface ISuperOrganization 
{

	/**
	 * コンストラクタ superorganizationのプロパティを初期化する
	 *
	 * @param string $name_ja 日本語表示名 
	 * @param string $name_en 英語表示名 
	 * @param string $id = null (オプション, デフォルト値 = null) レコードID
	 */
	public function __construct($name_ja, $name_en, $id = null);

	/**
	 * オブジェクトのIDを取得する
	 * 本操作はオブジェクトを変更しないように実装される
	 *
	 * @return int オブジェクトのID IDがセットされていない場合はnullを返す
	 */
	public function getId();

	/**
	 * オブジェクトのIDを設定する
	 *
	 * @param int $id オブジェクトにセットするレコードID
	 */
	public function setId($id);

	/**
	 * オブジェクトの日本語表示名を取得する
	 * 本操作はオブジェクトを変更しないように実装される
	 *
	 * @return string オブジェクトの日本語表示名を返す
	 */
	public function getNameJa();

	/**
	 * オブジェクトの日本語表示名を設定する
	 *
	 * @param string $name_ja オブジェクトに日本語表示名を設定する
	 */
	public function setNameJa($name_ja);

	/**
	 * オブジェクトの英語表示名を取得する
	 * 本操作はオブジェクトを変更しないように実装される
	 *
	 * @return string オブジェクトの英語表示名を返す
	 */
	public function getNameEn();

	/**
	 * オブジェクトの英語表示名を設定する
	 *
	 * @param string $name_en オブジェクトに英語表示名を設定する
	 */
	public function setNameEn($name_en);
};