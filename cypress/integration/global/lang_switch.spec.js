describe('switch language testing', () => {
  it('switch language', () => {
    cy.visit('/')

    cy.contains('Thai').click()
    cy.contains('เข้าสู่ระบบ')
    cy.contains('English').click()
    cy.contains('Login')
  })
})
