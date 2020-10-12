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
        Cypress.Cookies.preserveOnce('food_provision_system_session', 'XSRF-TOKEN')
    })

    it('switch language', () => {
        cy.contains('English').click()
        cy.contains('System')
    })

    it('Add unit', () => {
        cy.visit('admin/unit')
        cy.get('#unit').type('Test Unit')
        cy.get('[data-cy=create]').click()
        cy.contains('Success')
    })

    it('Add unit [unique value check]', () => {
        cy.visit('admin/unit')
        cy.wait(500)
        cy.get('#unit').type('Test Unit')
        cy.get('[data-cy=create]').click()
        cy.contains('The unit has already been taken.')
    })

    it('Update unit', () => {
        cy.visit('admin/unit')
        cy.wait(500)
        cy.get('#dataTable_filter > label > .form-control').type('Test Unit')
        cy.wait(1000)
        cy.get('.text-warning-dark > .fa-pencil').click()
        cy.get('#unit_edit').clear()
        cy.get('#unit_edit').type('Test Updated')
        cy.get('[data-cy=update]').click()
        cy.contains('Success')
        cy.get('.swal2-confirm').click()
        cy.get('#dataTable_filter > label > .form-control').type('Test Unit')
        cy.wait(1000)
        cy.contains('No matching records found')
    })

    it('Delete unit', () => {
        cy.get('#dataTable_filter > label > .form-control').clear()
        cy.get('#dataTable_filter > label > .form-control').type('Test Updated')
        cy.wait(1000)
        cy.get('.text-danger > .fa').click()
        cy.get('.swal2-confirm').click()
        cy.contains('Success')
        cy.get('.swal2-confirm').click()
        cy.get('#dataTable_filter > label > .form-control').type('Test Updated')
        cy.wait(1000)
        cy.contains('No matching records found')
    })

})
