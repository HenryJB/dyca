<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;
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
 * @property int $local_government_id
 * @property string $date_of_birth
 * @property int $first_choice
 * @property int $second_choice
 * @property int $session_id
 * @property int $learning_experience_id
 * @property string $about
 * @property string $project
 * @property string $information_source
 * @property int $sponsor_aid
 * @property int $sponsorship_status
 * @property int $terms_condition
 * @property string $date_registered
 * @property string $emergency_fullname
 * @property string $emergency_relationship
 * @property string $emergency_phone_number
 * @property string $emergency_secondary_phone_number
 *
 * @property LearningExperience $learningExperience
 * @property Tagging[] $taggings
 */
class Student extends \yii\db\ActiveRecord
{
  const SCENARIO_PROFILE_UPDATE = 'profile_update';
  const SCENARIO_UPDATE_PROFILE_PICTURE = 'update_profile_picture';
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
            [['first_name', 'last_name', 'gender', 'email_address', 'contact_address', 'phone_number', 'country', 'date_of_birth',  'session_id', 'learning_experience_id', 'about',  'date_registered','state_id','country'], 'required'],
            [['gender', 'contact_address', 'payment_status', 'approval_status', 'about', 'information_source'], 'string'],
            [['year', 'date_of_birth', 'date_registered'], 'safe'],
            [['date_of_birth'], 'validateAge'],
            [['state_id', 'local_government_id', 'first_choice', 'second_choice', 'session_id', 'learning_experience_id', 'sponsor_aid', 'sponsorship_status', 'terms_condition'], 'integer'],
            [['first_name', 'last_name'], 'string', 'max' => 200],
            [['email_address', 'phone_number', 'facebook_id', 'twitter_handle', 'instagram_handle'], 'string', 'max' => 100],
            [['occupation', 'photo', 'project'], 'string', 'max' => 255],
            [['country', 'emergency_fullname'], 'string', 'max' => 150],
            [['emergency_relationship', 'emergency_phone_number', 'emergency_secondary_phone_number'], 'string', 'max' => 50],
            [['email_address'], 'unique'],
            [['date_registered'], 'safe'],
            [['project','photo'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, gif, png, pdf, mp3, mov, mp4','maxSize' => 2048000, 'tooBig' => 'Limit is 2MB'],

            ['local_government_id', 'required', 'when' => function ($model) {
                  return $model->country == 160;
              }, 'whenClient' => "function (attribute, value) {
                  return $('#country').val() == '160';
              }"],

            [['learning_experience_id'], 'exist', 'skipOnError' => true, 'targetClass' => LearningExperience::className(), 'targetAttribute' => ['learning_experience_id' => 'id']],
        ];
    }


    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_PROFILE_UPDATE] = [
            'first_name', 'last_name', 'contact_address', 'phone_number','date_of_birth','about'
        ];

        $scenarios[self::SCENARIO_UPDATE_PROFILE_PICTURE] = ['photo'];

        return $scenarios;
    }

    public function validateAge($attribute, $params)
    {
        (int)$age = date("Y") - date("Y", strtotime($this->date_of_birth));

        if ($age < 18) {
            $this->addError('date_of_birth', 'You Must Be At Least 18 Years Of Age');
        }
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
            'local_government_id' => 'Local Government ID',
            'date_of_birth' => 'Date Of Birth',
            'first_choice' => 'First Choice',
            'second_choice' => 'Second Choice',
            'session_id' => 'Session ID',
            'learning_experience_id' => 'Learning Experience',
            'about' => 'About',
            'project' => 'Project',
            'information_source' => 'Information Source',
            'sponsor_aid' => 'Sponsor Aid',
            'sponsorship_status' => 'Sponsorship Status',
            'terms_condition' => 'Terms Condition',
            'date_registered' => 'Date Registered',
            'emergency_fullname' => 'Emergency Fullname',
            'emergency_relationship' => 'Emergency Relationship',
            'emergency_phone_number' => 'Emergency Phone Number',
            'emergency_secondary_phone_number' => 'Emergency Secondary Phone Number',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearningExperience()
    {
        return $this->hasOne(LearningExperience::className(), ['id' => 'learning_experience_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaggings()
    {
        return $this->hasMany(Tagging::className(), ['student_id' => 'id']);
    }


    public function changeProfilePicture(){
        $extensionsStack = array('png, jpg, jpeg, gif');

        $file = UploadedFile::getInstanceByName('photo');

        $img_name = $file->baseName.Yii::$app->getSecurity()->generateRandomString(5).'.'.$file->extension;

        //TODO CHECK IF THE FILE EXITS BEFORE UPLOADING IT

        if ($this->validate() && !empty($img_name)) {

          if(in_array($file->extension, $extensionsStack)){

            $file->saveAs(
                Url::to('@frontend/web/uploads/students/').$img_name
            );
                return $img_name;

          }else {

            $file->saveAs(
                Url::to('@frontend/web/uploads/students/').$img_name
            );

            return $img_name;
          }

        } else {
            return false;
        }
    }

}
