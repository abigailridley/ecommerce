//basic e2e test
describe("simple test ecommerce site", () => {
  const base = "http://localhost/ecommerce";

  //homepage test

  it("loads the homepage", () => {
    cy.visit(base);
    cy.contains("Welcome");
    cy.get("nav").should("be.visible");
  });

  //login page & form fields
  it("navigates to login page and checks form fields", () => {
    cy.visit(`${base}/login.php`);
    cy.contains("Login");
    cy.get("input[name='email']").should("exist");
    cy.get("input[name='pass']").should("exist");
  });

  //admin dashboard loads
  it("loads admin dashboard", () => {
    cy.visit(`${base}/read.php`);
    cy.contains("Admin Dashboard");

    cy.get(".card").should("exist");
  });

  //create new product page
  it("navigates to create new product page", () => {
    cy.visit(`${base}/create.php`);
    cy.contains("Add class");
    cy.get("[name='item_name']").should("exist");
    cy.get("[name='item_desc']").should("exist");
    cy.get("[name='item_price']").should("exist");
    cy.get("[name='item_img']").should("exist");
  });

  //edit product page
  // it("navigates to edit product page", () => {
  //   cy.visit(`${base}/update.php?id=1`);
  //   cy.contains("Update class");
  //   cy.get("input[name='Class name']").should("exist");
  //   cy.get("input[name='Description']").should("exist");
  //   cy.get("input[name='Price']").should("exist");
  //   cy.get("input[name='Image']").should("exist");
  // });
  //delete product page
  // it("navigates to delete product page", () => {
  //   cy.visit(`${base}/delete.php?id=1`);
  //   cy.contains("Delete class");
  //   cy.get("button").contains("Confirm").should("exist");
  //   cy.get("button").contains("Cancel").should("exist");
  // });
  //basic smoke test for for navbar links
  it("checks navbar links", () => {
    cy.visit(base);
    cy.contains("Admin").click();
    cy.contains("Admin Dashboard");

    cy.visit(base);
    cy.contains("Login").click();
    cy.contains("Login");
  });

  //smoke test for titles on each page
  it("checks page titles", () => {
    const pages = ["", "login.php", "read.php", "create.php"];

    pages.forEach((page) => {
      cy.visit(`${base}/${page}`);
      cy.get("title").should("exist");
    });
  });

  //test login functionality and redirection
  it("test login functionality", function () {
    cy.visit(`${base}/login.php`);
    cy.get("input[name='email']").type("meg@jones.com");
    cy.get("input[name='pass']").type("123");
    cy.get("input[type='submit']").click();
    cy.contains("Login successful");
    //check redirect to index.php after timeout
    cy.url().should("eq", `${base}/index.php`);
  });
});
