<?php

namespace common\models;

use Yii;
use yii\imagine\Image as ImageBox;
use Imagine\Image\Box;
use yii\helpers\Url;

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
 * @property string $date_of_birthday
 * @property int $session_id
 * @property string $about
 * @property string $propose_project
 * @property string $information_source
 * @property int $sponsor_aid
 * @property int $sponsorship_status
 * @property int $is_existing
 * @property string $tag
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
            [['first_name', 'last_name', 'gender', 'email_address', 'contact_address', 'phone_number', 'country', 'state_id', 'date_of_birth',
              'date_of_birth', 'session_id', 'about', 'is_existing', 'date_registered'], 'required'],
              ['local_government_id', 'required', 'when' => function ($model) {
                  return $model->country == 160;
              }, 'whenClient' => "function (attribute, value) {
                  return $('#country').val() == '160';
              }"],
            [['gender', 'contact_address', 'payment_status', 'approval_status', 'about',  'information_source'], 'string'],
            [['year', 'date_of_birth', 'date_registered'], 'safe'],
            [['state_id', 'local_government_id', 'first_choice', 'second_choice', 'session_id', 'sponsor_aid', 'sponsorship_status', 'is_existing', 'terms_condition'], 'integer'],
            [['first_name', 'last_name'], 'string', 'max' => 200],
            [['email_address', 'phone_number', 'facebook_id', 'twitter_handle', 'instagram_handle', 'tag'], 'string', 'max' => 100],
            [['occupation', 'photo'], 'string', 'max' => 255],
            [['country', 'emergency_fullname'], 'string', 'max' => 150],
            [['emergency_relationship', 'emergency_phone_number', 'emergency_secondary_phone_number'], 'string', 'max' => 50],
            [['email_address'], 'unique'],
            [['date_registered'], 'safe'],
            [['project'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, gif, png, pdf, mp3, mov, mp4']
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
            'state_id' => 'State',
            'local_government_id'=> 'Local Govt.(For Nigerians only)',
            'date_of_birth' => 'Date Of Birth',
            'first_choice' => 'Course',
            'second_choice' => 'Second Choice',
            'date_of_birthday' => 'Date Of Birthday',
            'session_id' => 'Session ',
            'about' => 'About You',
            'project' => 'Project',
            'information_source' => 'Information Source',
            'sponsor_aid' => 'Sponsor Aid',
            'sponsorship_status' => 'Sponsorship Status',
            'is_existing' => 'Is Existing',
            'tag' => 'Tag',
            'terms_condition' => 'Terms Condition',
            'date_registered' => 'Date Registered',
            'emergency_fullname' => 'Emergency Fullname',
            'emergency_relationship' => 'Emergency Relationship',
            'emergency_phone_number' => 'Emergency Phone Number',
            'emergency_secondary_phone_number' => 'Emergency Secondary Phone Number',
        ];
    }

    public function upload()
    {
        if ($this->validate()) {

            $this->project->saveAs(Url::to('@frontend/web/uploads/screening_projects/').$this->project->baseName.'.'.$this->project->extension);

            $image_extensions = array('jpg', 'gif', 'png');

            if(in_array($this->project->extension, $image_extensions)){
              ImageBox::thumbnail(Url::to('@frontend/web/uploads/screening_projects/').$this->project->baseName.'.'.$this->project->extension, 640, 350)
                ->resize(new Box(640, 350))
                ->save(Url::to('@frontend/web/uploads/screening_projects/thumbs/').$this->project->baseName.'.'.$this->project->extension,
                        ['quality' => 80]);
            }


            return true;
        } else {
            return false;
        }
    }
}
