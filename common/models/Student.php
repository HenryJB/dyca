<?php

namespace common\models;
use yii\web\UploadedFile;
use yii\helpers\Url;
use Yii;

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
 * @property string $date_of_birthday
 * @property int $session_id
 * @property string $about
 * @property string $project
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
 *
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

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_PROFILE_UPDATE] = [
            'first_name', 'last_name', 'email_address', 'contact_address', 'phone_number','date_of_birth','about'
        ];
        
        $scenarios[self::SCENARIO_UPDATE_PROFILE_PICTURE] = ['photo'];

        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'gender', 'email_address', 'contact_address', 'phone_number', 'country', 'state_id', 'date_of_birth',
              'date_of_birth', 'session_id', 'about', 'terms_condition', 'is_existing', 'date_registered'], 'required'],    
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
            [['project','photo'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, gif, png, pdf, mp3, mov, mp4','maxSize' => 2048000, 'tooBig' => 'Limit is 2MB'],
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
            'local_government_id' => 'Local Government ',
            'date_of_birth' => 'Date Of Birth',
            'first_choice' => 'First Choice',
            'second_choice' => 'Second Choice',
            'date_of_birthday' => 'Date Of Birthday',
            'session_id' => 'Session',
            'about' => 'About',
            'project' => 'Project',
            'information_source' => 'Information Source',
            'sponsor_aid' => 'Sponsor Aid',
            'sponsorship_status' => 'Sponsorship Status',
            'is_existing' => 'Is Existing',
            'tag' => 'Tag',
            'terms_condition' => '',
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
    public function getTaggings()
    {
        return $this->hasMany(Tagging::className(), ['student_id' => 'id']);
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

    public function sendEmail($email)
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'username' => $email,
        ]);

        if (!$user) {
            return false;
        }

        if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            if (!$user->save()) {
                return false;
            }
        }

        return Yii::$app
            ->mailer
            ->compose( '@frontend/mail/passwordResetToken.php',
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($email)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();
    }

}
