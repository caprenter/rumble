Feature:
When visiting any page the footer should be as I want it

  @supported
	Scenario: I should see the Bingley Town Council logo in the support us links and be able to click it.
    Given I am on "/"
	    Then I should see the text "Supported by" in the "supported_by" region
		And I should see the "Bingley Town Council Logo" logo in the "supported_by" region
		And I should see the text "Thanks to The 1887 Alfred Sharp Fund for funding our project for the Musical Education of Bingley residents." in the "supported_by" region

