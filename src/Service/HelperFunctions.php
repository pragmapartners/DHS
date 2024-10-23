<?php

namespace Drupal\pragma_services\Service;

class HelperFunctions
{

  /**
   * Builds the media output.
   */
  public function buildMediaObject(&$media_entity)
  {
    if (!$media_entity) {
      return null;
    }

    $parent_media_entity = $media_entity;

    if ($media_entity->bundle() == 'file') {
      return null;
    }

    switch ($media_entity->bundle()) {
      case 'image':
        $media_entity = $media_entity->get('field_media_image')->entity;
        break;
      case 'file':
        $media_entity = $media_entity->get('field_media_file')->entity;
        break;
      case 'video':
        $media_entity = $media_entity->get('field_media_video')->entity;
        break;
      case 'audio':
        $media_entity = $media_entity->get('field_media_audio')->entity;
        break;
      case 'document':
        $media_entity = $media_entity->get('field_media_document')->entity;
        break;
      default:
        return null;
    }

    $media = new \stdClass();

    $uri = $media_entity->getFileUri();
    $alt = $media_entity->alt;
    $file_uri = $media_entity->getFileUri();
    // $file_size = ByteSizeMarkup::create((int)$media_entity->get('filesize')->value);
    $file_name = $media_entity->get('filename')->value;
    $file_name = pathinfo($file_name, PATHINFO_FILENAME);
    $file_name = urldecode($file_name);
    $file_extension = pathinfo($media_entity->getFilename(), PATHINFO_EXTENSION);

    $file_url_generator = \Drupal::service('file_url_generator');
    $absolute_url = $file_url_generator->generateAbsoluteString($uri);

    $media->uri = $uri;
    $media->alt = $alt;
    $media->file_uri = $file_uri;
    // $media->file_size = $file_size;
    $media->absolute_url = $absolute_url;
    $media->file_name = $file_name;
    $media->file_extension = $file_extension;
    $media->image = \Drupal::entityTypeManager()->getViewBuilder('media')->view($parent_media_entity, 'default');

    return $media;
  }
}
