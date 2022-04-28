# Refactoring process

## Plan

- check if the only existing test works
- if it does, split it into multiple atomic tests, kill the code to check if the tests do fail, then see if it pass when the code is enabled
- create an interface for getTemplateComputed method. Given it is the entry to what could be an hexagon, createing an interface will "officialize" its status as primary adapter of the hexagon
- Make context test friendly by removing its Singleton pattern, creating an interface for the class, which will allow to create stubs
- Inject context to TemplateManager construct()
- Create a separe interface for every repository, allowing to type the getById() method for each one.
- At the same time, create an interface for every entity which could come from repositories, to be able to create the entities for a stub repository
- With each entity interface, begin to add business methods to the interface. If the methods are static, remove this behavior for a more object oriented one (example : Quote::renderText)
- Generate a DTO from the $data from getTemplateComputed to have typed parameters
- Alter the process in computeText to use the DTO, and to consume a middleware oriented chain of responsabilities to compute modifications
- All tests will go red
- Make it pass by adding the minimal responsibles
- Add tests on missing elements (user for instance) and go on the refactoring with that architecture.
- (Add a PSR-4 autoload with composer to be able to load classes without requires. Change namespaces of classes accordingly)

## Progression

- I won't atomize at first, there is much to fake, and the process to create a test is then a bit long for now. I just added one test to have it working.