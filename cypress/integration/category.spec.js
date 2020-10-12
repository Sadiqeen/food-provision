import faker from "faker"

describe('Category module', () => {

    const category =  faker.lorem.word()
    const category_update =  faker.lorem.word()

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

    it('Add category', () => {
        cy.visit('admin/category')
        cy.get('#category').type(category)
        cy.get('[data-cy=create]').click()
        cy.contains('Success')
    })

    it('Add category [unique value check]', () => {
        cy.visit('admin/category')
        cy.wait(500)
        cy.get('#category').type(category)
        cy.get('[data-cy=create]').click()
        cy.contains('The category has already been taken.')
    })

    it('Update category', () => {
        cy.visit('admin/category')
        cy.wait(500)
        cy.get('#dataTable_filter > label > .form-control').type(category)
        cy.wait(2000)
        cy.get('.text-warning-dark > .fa-pencil').click()
        cy.get('#category_edit').clear()
        cy.get('#category_edit').type(category_update)
        cy.get('[data-cy=update]').click()
        cy.contains('Success')
        cy.get('.swal2-confirm').click()
        cy.get('#dataTable_filter > label > .form-control').type(category)
        cy.wait(2000)
        cy.contains('No matching records found')
    })

    it('Delete category', () => {
        cy.get('#dataTable_filter > label > .form-control').clear()
        cy.get('#dataTable_filter > label > .form-control').type(category_update)
        cy.wait(2000)
        cy.get('.text-danger > .fa').click()
        cy.get('.swal2-confirm').click()
        cy.contains('Success')
        cy.get('.swal2-confirm').click()
        cy.get('#dataTable_filter > label > .form-control').type(category_update)
        cy.wait(2000)
        cy.contains('No matching records found')
    })

})
