<?php

require_once(dirname(__FILE__).'/ISuperOrganization.interface.php');

/**
 * interface ISuperOrganizationDAO
 *
 * superorganization�e�[�u����Data Access Object�̃C���^�[�t�F�C�X(API��`)
 *
 * @author : TOIDA Yuto 2014/11/19
*/

interface ISuperOrganizationDAO
{

	/**
	 * �R���X�g���N�^ ISuperOrganizatinDAO�C���^�[�t�F�C�X�����������N���X�̃I�u�W�F�N�g������������
	 * �R���X�g���N�^�͈�����&$PDOObject��ύX���Ȃ��悤�Ɏ��������
	 *
	 * @param PDO &$PDOObject superorganization�e�[�u���̑��݂���f�[�^�x�[�X�փA�N�Z�X�\��PDO�I�u�W�F�N�g
	 */
	public function __construct(&$PDOObject);
	
	/**
	 * ���R�[�hID���w�肵��ISuperOrganization�C���^�[�t�F�C�X�����������N���X�̃I�u�W�F�N�g���擾����
	 *
	 * @param int $id SELECT����ۂɎg�p����superorganization_id
	 * @return ISuperOrganization $id�ɑΉ����郌�R�[�h
	 */
	public function selectSuperOrganizationById($id);

	/**
	 * superorganization�e�[�u���ɑ��݂���S�Ẵ��R�[�h���擾����
	 *
	 * @return array superorganization�e�[�u���̑S���R�[�h��ISuperOrganization�C���^�[�t�F�C�X�����������N���X�̃I�u�W�F�N�g�z��ŕԂ�
	 */
	public function selectAllSuperOrganizations();

	/**
	 * ISuperOrganization�I�u�W�F�N�g���f�[�^�x�[�X��INSERT����
	 *
	 * @param ISuperOrganization &$superOrganization �f�[�^�x�[�X��INSERT����f�[�^����͂���ISuperOrganization�I�u�W�F�N�g id�̒l�͖��������
	 */
	public function insertSuperOrganization(&$superOrganization);

	/**
	 * ������ISsuperOrganization�I�u�W�F�N�g��ID�����������R�[�h�������̂��̑��̒l��UPDATE����
	 * &$superOrganization�I�u�W�F�N�g�͕ύX����Ȃ��悤�Ɏ��������
	 *
	 * @param ISuperOrganization &$superOrganization UPDATE����f�[�^����͂���ISuperOrganization�I�u�W�F�N�g
	 */
	public function updateSuperOrganization(&$superOrganization);

	/**
	 * ID�Ŏw�肵�����R�[�h��DELETE����
	 *
	 * @param int $id DELETE���郌�R�[�h��id
	 */
	public function deleteSuperOrganizationById($id);

	/**
	 * �����ƑS�Ă̒l���������R�[�h��DELETE����
	 * &$superOrganization�I�u�W�F�N�g�͕ύX����Ȃ��悤�Ɏ��������
	 *
	 * @param ISuperOrganization &$superOrganization DELETE���郌�R�[�h�ƈ�v����ISuperOrganization�I�u�W�F�N�g
	 */
	public function deleteSuperOrganizationByInstance(&$superOrganization);
};
