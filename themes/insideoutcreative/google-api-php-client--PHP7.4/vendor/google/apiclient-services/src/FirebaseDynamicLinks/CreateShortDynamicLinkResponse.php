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

namespace Google\Service\FirebaseDynamicLinks;

class CreateShortDynamicLinkResponse extends \Google\Collection
{
  protected $collection_key = 'warning';
  /**
   * @var string
   */
  public $previewLink;
  /**
   * @var string
   */
  public $shortLink;
  protected $warningType = DynamicLinkWarning::class;
  protected $warningDataType = 'array';
  public $warning = [];

  /**
   * @param string
   */
  public function setPreviewLink($previewLink)
  {
    $this->previewLink = $previewLink;
  }
  /**
   * @return string
   */
  public function getPreviewLink()
  {
    return $this->previewLink;
  }
  /**
   * @param string
   */
  public function setShortLink($shortLink)
  {
    $this->shortLink = $shortLink;
  }
  /**
   * @return string
   */
  public function getShortLink()
  {
    return $this->shortLink;
  }
  /**
   * @param DynamicLinkWarning[]
   */
  public function setWarning($warning)
  {
    $this->warning = $warning;
  }
  /**
   * @return DynamicLinkWarning[]
   */
  public function getWarning()
  {
    return $this->warning;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(CreateShortDynamicLinkResponse::class, 'Google_Service_FirebaseDynamicLinks_CreateShortDynamicLinkResponse');
