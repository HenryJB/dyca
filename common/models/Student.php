<?php

namespace common\models;

use Yii;
use common\models\DcaUser;

/**
 * This is the model class for table "students".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $gender
 * @property string $email_address
 * @property string $contact_address
 * @property string $phone_number
 * @property string $occupation
 * @property string $photo
 * @property string $facebook_id
 * @property string $twitter_handle
 * @property string $instagram_handle
 * @property string $year
 * @property string $payment_status
 * @property string $approval_status
 * @property string $country
 * @property int $state_id
 * @property string $date_of_birth
 * @property int $first_choice
 * @property int $second_choice
 * @property string $reason
 * @property string $propose_project
 * @property string $information_source
 * @property int $sponsor_aid
 * @property int $sponsorship_status
 * @property int $is_existing
 * @property int $terms_condition
 * @property string $date_registered
 * @property string $emergency_fullname
 * @property string $emergency_relationship
 * @property string $emergency_phone_number
 * @property string $emergency_secondary_phone_number
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'students';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'gender', 'email_address', 'contact_address', 'phone_number', 'country', 'date_of_birth', 'reason', 'information_source', 'emergency_fullname', 'emergency_relationship', 'emergency_phone_number', 'emergency_secondary_phone_number'], 'required'],
            [['gender', 'contact_address', 'payment_status', 'approval_status', 'reason', 'propose_project', 'information_source'], 'string'],
            [['year', 'date_of_birth', 'date_registered'], 'safe'],
            [['state_id', 'first_choice', 'second_choice', 'sponsor_aid', 'sponsorship_status', 'is_existing', 'terms_condition'], 'integer'],
            [['first_name', 'last_name'], 'string', 'max' => 200],
            [['email_address', 'phone_number', 'facebook_id', 'twitter_handle', 'instagram_handle'], 'string', 'max' => 100],
            [['occupation', 'photo'], 'string', 'max' => 255],
            [['country', 'emergency_fullname'], 'string', 'max' => 150],
            [['emergency_relationship', 'emergency_phone_number', 'emergency_secondary_phone_number'], 'string', 'max' => 50],
            [['email_address'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'gender' => 'Gender',
            'email_address' => 'Email Address',
            'contact_address' => 'Contact Address',
            'phone_number' => 'Phone Number',
            'occupation' => 'Occupation',
            'photo' => 'Photo',
            'facebook_id' => 'Facebook ID',
            'twitter_handle' => 'Twitter Handle',
            'instagram_handle' => 'Instagram Handle',
            'year' => 'Year',
            'payment_status' => 'Payment Status',
            'approval_status' => 'Approval Status',
            'country' => 'Country',
            'state_id' => 'State ID',
            'date_of_birth' => '',
            'first_choice' => 'First Choice',
            'second_choice' => 'Second Choice',
            'reason' => 'Reason',
            'propose_project' => 'Propose Project',
            'information_source' => 'Information Source',
            'sponsor_aid' => 'Sponsor Aid',
            'sponsorship_status' => 'Sponsorship Status',
            'is_existing' => 'Is Existing',
            'terms_condition' => 'Terms Condition',
            'date_registered' => 'Date Registered',
            'emergency_fullname' => 'Emergency Fullname',
            'emergency_relationship' => 'Emergency Relationship',
            'emergency_phone_number' => 'Emergency Phone Number',
            'emergency_secondary_phone_number' => 'Emergency Secondary Phone Number',
        ];
    }

    public function createStudentCredentials($email,$password)
    {
        $model = '';
        $model->user = $modelDcaUser->generateUniqueRandomString('password');
        $model->password = $modelDcaUser->generateUniqueRandomString('password');

        return true;
    }

}
