<?php
/**
 * @file
 * Contains \Drupal\specbee_vishak\Plugin\Block\TimeZoneBlock.
 */
namespace Drupal\specbee_vishak\Plugin\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\specbee_vishak\TimezoneService;
/**
 * Provides a 'timezone' block.
 *
 * @Block(
 *   id = "timezone_block",
 *   admin_label = @Translation("Timezone block"),
 *   category = @Translation("Custom timezone block example")
 * )
 */
class TimeZoneBlock extends BlockBase implements ContainerFactoryPluginInterface
{
    /**
     * @var \Drupal\specbee_vishak\TimezoneService
     */
    protected $TimeZoneService;

    /**
     * Timezone constructor.
     *
     * @param array $configuration
     * @param $plugin_id
     * @param $plugin_definition
     * @param $TimeZoneService \Drupal\specbee_vishak\TimezoneService
     */
    public function __construct(array $configuration, $plugin_id, $plugin_definition, $TimeZoneService)
    {
        parent::__construct($configuration, $plugin_id, $plugin_definition);
        $this->TimeZoneService = $TimeZoneService;
    }

    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition)
    {
        return new static ($configuration, $plugin_id, $plugin_definition, $container->get('specbee_vishak.timezone_calc'));
    }

    /**
     * {@inheritdoc}
     */
    public function build()
    {
        $timezone = $this
            ->TimeZoneService
            ->getTimeZone();
        return ['#theme' => 'timezone-template', '#time' => $timezone[0], '#city' => $timezone[1], '#cache' => [
            'max-age' => 0,
          ] ];

    }
    /**
     * {@inheritdoc}
     *
     */
    public function getCacheMaxAge()
    {
        return 0;
    }
}

