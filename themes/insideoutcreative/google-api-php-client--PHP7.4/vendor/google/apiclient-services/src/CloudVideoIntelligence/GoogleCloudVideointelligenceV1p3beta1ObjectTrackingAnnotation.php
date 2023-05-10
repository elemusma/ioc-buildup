<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Google\Service\CloudVideoIntelligence;

class GoogleCloudVideointelligenceV1p3beta1ObjectTrackingAnnotation extends \Google\Collection
{
  protected $collection_key = 'frames';
  /**
   * @var float
   */
  public $confidence;
  protected $entityType = GoogleCloudVideointelligenceV1p3beta1Entity::class;
  protected $entityDataType = '';
  public $entity;
  protected $framesType = GoogleCloudVideointelligenceV1p3beta1ObjectTrackingFrame::class;
  protected $framesDataType = 'array';
  public $frames = [];
  protected $segmentType = GoogleCloudVideointelligenceV1p3beta1VideoSegment::class;
  protected $segmentDataType = '';
  public $segment;
  /**
   * @var string
   */
  public $trackId;
  /**
   * @var string
   */
  public $version;

  /**
   * @param float
   */
  public function setConfidence($confidence)
  {
    $this->confidence = $confidence;
  }
  /**
   * @return float
   */
  public function getConfidence()
  {
    return $this->confidence;
  }
  /**
   * @param GoogleCloudVideointelligenceV1p3beta1Entity
   */
  public function setEntity(GoogleCloudVideointelligenceV1p3beta1Entity $entity)
  {
    $this->entity = $entity;
  }
  /**
   * @return GoogleCloudVideointelligenceV1p3beta1Entity
   */
  public function getEntity()
  {
    return $this->entity;
  }
  /**
   * @param GoogleCloudVideointelligenceV1p3beta1ObjectTrackingFrame[]
   */
  public function setFrames($frames)
  {
    $this->frames = $frames;
  }
  /**
   * @return GoogleCloudVideointelligenceV1p3beta1ObjectTrackingFrame[]
   */
  public function getFrames()
  {
    return $this->frames;
  }
  /**
   * @param GoogleCloudVideointelligenceV1p3beta1VideoSegment
   */
  public function setSegment(GoogleCloudVideointelligenceV1p3beta1VideoSegment $segment)
  {
    $this->segment = $segment;
  }
  /**
   * @return GoogleCloudVideointelligenceV1p3beta1VideoSegment
   */
  public function getSegment()
  {
    return $this->segment;
  }
  /**
   * @param string
   */
  public function setTrackId($trackId)
  {
    $this->trackId = $trackId;
  }
  /**
   * @return string
   */
  public function getTrackId()
  {
    return $this->trackId;
  }
  /**
   * @param string
   */
  public function setVersion($version)
  {
    $this->version = $version;
  }
  /**
   * @return string
   */
  public function getVersion()
  {
    return $this->version;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudVideointelligenceV1p3beta1ObjectTrackingAnnotation::class, 'Google_Service_CloudVideoIntelligence_GoogleCloudVideointelligenceV1p3beta1ObjectTrackingAnnotation');
