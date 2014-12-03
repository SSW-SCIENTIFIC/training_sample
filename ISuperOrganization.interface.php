<?php

/**
 * interface ISuperOrganization
 *
 * superorganization�e�[�u����Data Transfer Object�̃C���^�[�t�F�C�X(API��`)
 *
 * @author : TOIDA Yuto 2014/11/19
*/

interface ISuperOrganization 
{

	/**
	 * �R���X�g���N�^ superorganization�̃v���p�e�B������������
	 *
	 * @param string $name_ja ���{��\���� 
	 * @param string $name_en �p��\���� 
	 * @param string $id = null (�I�v�V����, �f�t�H���g�l = null) ���R�[�hID
	 */
	public function __construct($name_ja, $name_en, $id = null);

	/**
	 * �I�u�W�F�N�g��ID���擾����
	 * �{����̓I�u�W�F�N�g��ύX���Ȃ��悤�Ɏ��������
	 *
	 * @return int �I�u�W�F�N�g��ID ID���Z�b�g����Ă��Ȃ��ꍇ��null��Ԃ�
	 */
	public function getId();

	/**
	 * �I�u�W�F�N�g��ID��ݒ肷��
	 *
	 * @param int $id �I�u�W�F�N�g�ɃZ�b�g���郌�R�[�hID
	 */
	public function setId($id);

	/**
	 * �I�u�W�F�N�g�̓��{��\�������擾����
	 * �{����̓I�u�W�F�N�g��ύX���Ȃ��悤�Ɏ��������
	 *
	 * @return string �I�u�W�F�N�g�̓��{��\������Ԃ�
	 */
	public function getNameJa();

	/**
	 * �I�u�W�F�N�g�̓��{��\������ݒ肷��
	 *
	 * @param string $name_ja �I�u�W�F�N�g�ɓ��{��\������ݒ肷��
	 */
	public function setNameJa($name_ja);

	/**
	 * �I�u�W�F�N�g�̉p��\�������擾����
	 * �{����̓I�u�W�F�N�g��ύX���Ȃ��悤�Ɏ��������
	 *
	 * @return string �I�u�W�F�N�g�̉p��\������Ԃ�
	 */
	public function getNameEn();

	/**
	 * �I�u�W�F�N�g�̉p��\������ݒ肷��
	 *
	 * @param string $name_en �I�u�W�F�N�g�ɉp��\������ݒ肷��
	 */
	public function setNameEn($name_en);
};