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

namespace Google\Service\Container;

class OperationProgress extends \Google\Collection
{
  protected $collection_key = 'stages';
  protected $metricsType = Metric::class;
  protected $metricsDataType = 'array';
  public $metrics = [];
  /**
   * @var string
   */
  public $name;
  protected $stagesType = OperationProgress::class;
  protected $stagesDataType = 'array';
  public $stages = [];
  /**
   * @var string
   */
  public $status;

  /**
   * @param Metric[]
   */
  public function setMetrics($metrics)
  {
    $this->metrics = $metrics;
  }
  /**
   * @return Metric[]
   */
  public function getMetrics()
  {
    return $this->metrics;
  }
  /**
   * @param string
   */
  public function setName($name)
  {
    $this->name = $name;
  }
  /**
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }
  /**
   * @param OperationProgress[]
   */
  public function setStages($stages)
  {
    $this->stages = $stages;
  }
  /**
   * @return OperationProgress[]
   */
  public function getStages()
  {
    return $this->stages;
  }
  /**
   * @param string
   */
  public function setStatus($status)
  {
    $this->status = $status;
  }
  /**
   * @return string
   */
  public function getStatus()
  {
    return $this->status;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(OperationProgress::class, 'Google_Service_Container_OperationProgress');
