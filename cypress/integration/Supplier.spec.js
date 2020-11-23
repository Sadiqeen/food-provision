describe('Supplier module', () => {
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

    it('Add supplier', () => {
        cy.visit('admin/supplier')
        cy.contains('Add Supplier').click()
        cy.get('#name').type('TestingSupplier')
        cy.get('#tel').type('080-365-4563')
        cy.get('#email').type('testing@testing.com')
        cy.get('#address').type('testing address')
        cy.get('.btn-success').click()
        cy.contains('Success')
        cy.get('.swal2-confirm').click()
    })

    it('Add supplier [unique value check]', () => {
        cy.visit('admin/supplier')
        cy.contains('Add Supplier').click()
        cy.get('#name').type('TestingSupplier')
        cy.get('#tel').type('080-365-4563')
        cy.get('#email').type('testing@testing.com')
        cy.get('#address').type('testing address')
        cy.get('.btn-success').click()
        cy.contains('The name has already been taken.')
        cy.contains('The tel has already been taken.')
        cy.contains('The email has already been taken.')
    })

    it('Update supplier', () => {
        cy.visit('admin/supplier')
        cy.wait(500)
        cy.get('#dataTable_filter > label > .form-control').type('TestingSupplier')
        cy.wait(1000)
        cy.get('.text-warning-dark > .fa-pencil').click()
        cy.get('#name').clear()
        cy.get('#name').type('Testing')
        cy.get('.btn-success').click()
        cy.contains('Success')
        cy.get('.swal2-confirm').click()
        cy.get('#dataTable_filter > label > .form-control').type('TestingSupplier')
        cy.wait(1000)
        cy.contains(/No matching records found|No data available in table/g)
    })

    it('Delete supplier', () => {
        cy.get('#dataTable_filter > label > .form-control').clear()
        cy.get('#dataTable_filter > label > .form-control').type('Testing')
        cy.wait(1000)
        cy.get('.text-danger > .fa').click()
        cy.get('.swal2-confirm').click()
        cy.contains('Success')
        cy.get('.swal2-confirm').click()
        cy.get('#dataTable_filter > label > .form-control').type('Testing')
        cy.wait(1000)
        cy.contains(/No matching records found|No data available in table/g)
    })

})
