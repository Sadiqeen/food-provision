describe('Customer module', () => {
    before(() => {
        cy.clearCookies()
        cy.visit('/')

        cy.get('input[name="email"]').clear()
        cy.get('input[name="email"]').type('admin@admin.com')
        cy.get('input[name="password"]').clear()
        cy.get('input[name="password"]').type('password')
        cy.get('button[type="submit"]').click()
        cy.url().should('include', '/dashboard')
    })

    beforeEach(() => {
        Cypress.Cookies.preserveOnce('food_provision_application_session', 'XSRF-TOKEN')
    })

    it('switch language', () => {
        cy.contains('English').click()
        cy.contains('System')
    })

    it('Add customer', () => {
        cy.visit('admin/customer')
        cy.contains('Add Customer').click()
        cy.get('#name').type('EH LTD')
        cy.get('#coordinator').type('Dolore consequatur')
        cy.get('#tel').type('084-659-6656')
        cy.get('#email').type('testcustomer@customer.com')
        cy.get('#address').type('Testing address')
        cy.get('#note').type('Testing note')
        cy.get('#password').type('password')
        cy.get('#password-confirm').type('password')
        cy.get('.btn-success').click()
        cy.contains('Success')
    })

    it('Add customer [unique value check]', () => {
        cy.visit('admin/customer')
        cy.contains('Add Customer').click()
        cy.get('#name').type('EH LTD')
        cy.get('#coordinator').type('Dolore consequatur')
        cy.get('#tel').type('084-659-6656')
        cy.get('#email').type('testcustomer@customer.com')
        cy.get('#address').type('Testing address')
        cy.get('#note').type('Testing note')
        cy.get('#password').type('password')
        cy.get('#password-confirm').type('password')
        cy.get('.btn-success').click()
        cy.contains('The name has already been taken.')
        cy.contains('The coordinator has already been taken.')
        cy.contains('The tel has already been taken.')
        cy.contains('The email has already been taken.')
    })

    it('Update customer', () => {
        cy.visit('admin/customer')
        cy.wait(500)
        cy.get('#dataTable_filter > label > .form-control').type('EH LTD')
        cy.wait(1000)
        cy.get('.text-warning-dark > .fa-pencil').click()
        cy.get('#name').clear()
        cy.get('#name').type('EH Company')
        cy.get('.btn-success').click()
        cy.contains('Success')
        cy.get('.swal2-confirm').click()
        cy.get('#dataTable_filter > label > .form-control').type('EH LTD')
        cy.wait(1000)
        cy.contains(/No matching records found|No data available in table/g)
    })

    it('Customer can sign in', () => {
        cy.get('#navbarSupportedContent > .navbar-nav > .nav-item > #navbarDropdown').click()
        cy.get('#navbarSupportedContent > .navbar-nav > .nav-item > .dropdown-menu > .dropdown-item').click()
        cy.get('input[name="email"]').clear()
        cy.get('input[name="email"]').type('testcustomer@customer.com')
        cy.get('input[name="password"]').clear()
        cy.get('input[name="password"]').type('password')
        cy.get('button[type="submit"]').click()
        cy.url().should('include', '/dashboard')
    })

    it('Customer permission', () => {
        cy.visit('admin/customer')
        cy.url().should('include', '/dashboard')
    })

    it('Delete customer', () => {
        cy.get('#navbarSupportedContent > .navbar-nav > .nav-item > #navbarDropdown').click()
        cy.get('#navbarSupportedContent > .navbar-nav > .nav-item > .dropdown-menu > .dropdown-item').click()

        cy.clearCookies()
        cy.visit('/')

        cy.get('input[name="email"]').clear()
        cy.get('input[name="email"]').type('admin@admin.com')
        cy.get('input[name="password"]').clear()
        cy.get('input[name="password"]').type('password')
        cy.get('button[type="submit"]').click()
        cy.url().should('include', '/dashboard')

        cy.visit('admin/customer')
        cy.get('#dataTable_filter > label > .form-control').clear()
        cy.get('#dataTable_filter > label > .form-control').type('EH Company')
        cy.wait(1000)
        cy.get('.text-danger > .fa').click()
        cy.get('.swal2-confirm').click()
        cy.contains('Success')
        cy.get('.swal2-confirm').click()
        cy.get('#dataTable_filter > label > .form-control').type('EH Company')
        cy.wait(1000)
        cy.contains(/No matching records found|No data available in table/g)
    })

})
