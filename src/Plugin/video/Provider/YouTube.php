<?php

/**
 * @file
 * Contains \Drupal\video\Plugin\video\Provider\YouTube.
 */

namespace Drupal\video\Plugin\video\Provider;

use Drupal\video\ProviderPluginBase;

/**
 * @VideoEmbeddableProvider(
 *   id = "youtube",
 *   label = @Translation("YouTube"),
 *   description = @Translation("YouTube Video Provider"),
 *   regular_expressions = {
 *     "@(?:(?<protocol>http|https):)?//(?:www\.)?youtube(?<cookie>-nocookie)?\.com/embed/(?<id>[a-z0-9_-]+)@i",
 *     "@(?:(?<protocol>http|https):)?//(?:www\.)?youtube(?<cookie>-nocookie)?\.com/v/(?<id>[a-z0-9_-]+)@i",
 *     "@(?:(?<protocol>http|https):)?//(?:www\.)?youtube(?<cookie>-nocookie)?\.com/watch(\?|\?.*\&)v=(?<id>[a-z0-9_-]+)@i",
 *     "@(?:(?<protocol>http|https):)?//youtu(?<cookie>-nocookie)?\.be/(?<id>[a-z0-9_-]+)@i"
 *   },
 *   mimetype = "video/youtube",
 *   stream_wrapper = "youtube"
 * )
 */
class YouTube extends ProviderPluginBase {

  /**
   * {@inheritdoc}
   */
  public function renderEmbedCode($width, $height, $autoplay) {
    return [
      '#type' => 'html_tag',
      '#tag' => 'iframe',
      '#attributes' => [
        'width' => $width,
        'height' => $height,
        'frameborder' => '0',
        'allowfullscreen' => 'allowfullscreen',
        'src' => sprintf('https://www.youtube.com/embed/%s?autoplay=%d&start=%d', $this->getVideoId(), $autoplay, $this->getTimeIndex()),
      ],
    ];
  }
}