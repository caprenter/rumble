<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Drupal\DrupalExtension\Context\MinkContext;
use Drupal\DrupalExtension\Selector\RegionSelector;
use Behat\Mink\Selector\SelectorInterface;
use Behat\Mink\Selector\CssSelector;
//use Behat\MinkExtension\Context\MinkContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context
//class FeatureContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

private function assetChecker($assetType, $assetSource, $assetCode){
			
    $assetElements = $this->getSession()->getPage()->findAll('css',$assetType);
    foreach($assetElements as $asset){
        $assetUrl = ($asset->getAttribute($assetSource));

        // need to remove mailto links
        if (!str_contains(strval($assetUrl), 'mailto')){
            $this->visit($assetUrl);
            print($assetUrl . "\n");
            $this->assertResponseStatusIsNot($assetCode);
            $this->getSession()->back();
        }
    }
}

    /**
     * @Then the images should not return :arg1
     */
    public function theImagesShouldNotReturn($code)
    {
			$this->assetChecker('img', 'src', $code);
    }

    /**
     * @Then the links should not return :arg1
     */
    public function theLinksShouldNotReturn($code)
    {
			$this->assetChecker('a', 'href', $code);
    }


    /**
     * @Then I should see the :arg1 logo in the :arg2 region
     */
    public function iShouldSeeTheLogoInTheRegion($arg1, $region)
    {

        $regionObj = $this->getRegion($region);

        // Find the link within the region
        $linkObj = $regionObj->find('xpath', '//img[@alt="'.$arg1.'"]');
        if (empty($linkObj)) {
            throw new \Exception(sprintf('The link "%s" was not found in the region "%s" on the page %s', $arg1, $region, $this->getSession()->getCurrentUrl()));
        }
        //$linkObj->click();
    }
    // {
    //     $session = $this->getSession();
    //     // $element = $session->getPage()->find(
    //     //     'xpath',
    //     //     $session->getSelectorsHandler()->selectorToXpath('xpath', '//img[@alt="'.$arg1.'"]')
    //     // );

    //     // if (null === $element) {
    //     //     throw new \InvalidArgumentException(sprintf('Cannot find the logo: "%s"', $arg1));
    //     // }

    //     //$region = new Drupal\DrupalExtension\Context\MinkContext;
    //     $region = $this->getRegion($arg2);
    // }
    
    //ATTEMPT 1
    //From: https://gist.github.com/acouch/9784746
    // Leaflet icons don't have ids (at least the ones I'm using). Here we can click them by the z-index which is
    // the only unique id.
  
    /**
     * Click on map icon as identified by its z-index.
     *
     * @Given /^I click map icon with the title "([^"]*)"$/
     */
    public function iClickMapIcon($title) {
        $session = $this->getSession();
        $element = $session->getPage()->find(
            'xpath',
            $session->getSelectorsHandler()->selectorToXpath('xpath', '//img[@title="'.$title.'"]')

        );
        if (null === $element) {
            throw new \InvalidArgumentException(sprintf('Cannot find map icon: "%s"', $title));
        }
        $element->click();
    }
    
    
    
    //ATTEMPT 2
    
     /**
    * Click on the element with the provided xpath query
    *
    * @When /^I click on the element with xpath "([^"]*)"$/
    */
   public function iClickOnTheElementWithXPath($xpath)
   {
       $session = $this->getSession(); // get the mink session
       $element = $session->getPage()->find('xpath',$session->getSelectorsHandler()->selectorToXpath('xpath', $xpath)); // runs the actual query and returns the element

       // errors must not pass silently
       if (null === $element) {
           throw new \InvalidArgumentException(sprintf('Could not evaluate XPath: "%s"', $xpath));
       }

       // ok, let's click on it
       $element->click();

   }
   
   
     /**
     * @Then I should see a map with a marker on it
     */
    public function iShouldSeeAMapWithAMarkerOnIt()
    {
        $session = $this->getSession(); // get the mink session
       $element = $session->getPage()->find('xpath',$session->getSelectorsHandler()->selectorToXpath('xpath', '/body/div/div/div/section/div/article/div/div[8]/div/div[1]/div[4]/img')); // runs the actual query and returns the element

       // errors must not pass silently
       if (null === $element) {
           throw new \InvalidArgumentException(sprintf('Could not evaluate XPath: "%s"', $xpath));
       }
    }

   

  /**
   * @Then I should see :arg2 :arg1 item(s)
   */
  public function iShouldSeeItems($number, $area)
  {
		switch($area){
			case "news":
		   	$area_search = ".news";
				break;
      case "news card":
		   	$area_search = ".card";
				break;
			case "incident":
		   	$area_search = ".incident";
				break;
      case "safety tip":
		   	$area_search = ".safety-tip";
				break;
			case "video":
		   	$area_search = ".video-embed-field-provider-youtube";
				break;		
		}
		$nodes =  $this->getSession()->getPage()->findAll('css', $area_search);
		if ($number != count($nodes)){
			throw new Exception("The number of " . $area . " items is " . count($nodes) . " and should be " . $number . ".");
		}
  }
  /**
   * @Given :arg1 is logged on
   */
  public function isLoggedOn($arg1)
  {
      $this->visitPath('/user');
      $this->getSession()->getPage()->fillField('Username', 'testuser');
      $this->getSession()->getPage()->fillField('Password', 'testpassword123');
      $this->getSession()->getPage()->pressButton('Log in');
  }

}
