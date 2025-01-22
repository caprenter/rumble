Feature:
When visiting the Gallery page

  @headings
  Scenario: I should see the page split into the following sections:.
    Given I am on "/gallery"
    Then I should not see the text "The full photo collection is"

