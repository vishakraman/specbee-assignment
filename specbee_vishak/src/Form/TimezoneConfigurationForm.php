<?php  
/**  
 * @file  
 * Contains Drupal\specbee_vishak\Form\TimezoneConfigurationForm.  
 */  
namespace Drupal\specbee_vishak\Form;  
use Drupal\Core\Form\ConfigFormBase;  
use Drupal\Core\Form\FormStateInterface;  

class TimezoneConfigurationForm extends ConfigFormBase {  
    /**  
   * {@inheritdoc}  
   */  
  protected function getEditableConfigNames() {  
    return [  
      'timezone.adminsettings',  
    ];  
  }

   /**  
   * {@inheritdoc}  
   */  
  public function getFormId() {  
    return 'timezone_form';  
  } 
    /**  
   * {@inheritdoc}  
   */  
  public function buildForm(array $form, FormStateInterface $form_state) {  
    $config = $this->config('timezone.adminsettings');  

    $form['country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Country'),
      '#default_value' => $config->get('country'),
      '#required' => TRUE,
    ];

    $form['city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('City'),
      '#default_value' => $config->get('city'),
      '#required' => TRUE,
    ];
        // Select.
    $form['timezone'] = [
      '#type' => 'select',
      '#title' => $this->t('Timezone'),
      '#options' => [
        'America/Chicago' => $this->t('America/Chicago'),
        'America/New_York' => $this->t('America/New_York'),
        'Asia/Tokyo' => $this->t('Asia/Tokyo'),
        'Asia/Dubai' => $this->t('Asia/Dubai'),
        'Asia/Kolkata' => $this->t('Asia/Kolkata'),
        'Europe/Amsterdam' => $this->t('Europe/Amsterdam'),
        'Europe/Oslo' => $this->t('Europe/Oslo'),
        'Europe/London' => $this->t('Europe/London'),
      ],
     // '#empty_option' => $this->t('-select-'),
      '#default_value' => $config->get('timezone'),
      '#description' => $this->t('Select, #type = select'),
    ];
    return parent::buildForm($form, $form_state);  
  }  

   /**  
   * {@inheritdoc}  
   */  
  public function submitForm(array &$form, FormStateInterface $form_state) {  
    parent::submitForm($form, $form_state);  

    $this->config('timezone.adminsettings')  
      ->set('country', $form_state->getValue('country'))  
      ->set('city', $form_state->getValue('city'))  
      ->set('timezone', $form_state->getValue('timezone'))  
      ->save();  
  }  
}  
  