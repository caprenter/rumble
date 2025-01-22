Feature:
When visiting the Instrument page

  @headings
   Scenario Outline: I should see the page split into the following sections:.
    Given I am on "/instruments"
    Then I should see the heading <named>

	Examples:
	  | named |
	  | "Shop" |
	  | "Re-home" |
    | "Effects Library" |
    | "Donate an instrument" |
    | "Request an instrument" |
    | "Available Instruments" |
    | "Reserved for Collection" |
    | "On Loan" |
    | "We’ve distributed the following" |
