describe('Authentication', () => {
  beforeEach(() => {
    cy.visit('/')
  })

  it('Sign in with wrong account [Eng]', () => {
    cy.contains('English').click()
    cy.contains('Login')
    cy.get('input[name="email"]').clear()
    cy.get('input[name="email"]').type('test@test.com')
    cy.get('input[name="password"]').clear()
    cy.get('input[name="password"]').type('password')
    cy.get('button[type="submit"]').click()
    cy.contains('These credentials do not match our records')
  })

  it('Sign in with wrong account [Thai]', () => {
    cy.contains('Thai').click()
    cy.contains('เข้าสู่ระบบ')
    cy.get('input[name="email"]').clear()
    cy.get('input[name="email"]').type('test@test.com')
    cy.get('input[name="password"]').clear()
    cy.get('input[name="password"]').type('password')
    cy.get('button[type="submit"]').click()
    cy.contains('อีเมลล์หรือชื่อผู้ใช้ที่ระบุไม่มีในระบบ')
  })

  it('Sign in with right account', () => {
    cy.get('input[name="email"]').clear()
    cy.get('input[name="email"]').type('admin@admin.com')
    cy.get('input[name="password"]').clear()
    cy.get('input[name="password"]').type('password')
    cy.get('button[type="submit"]').click()
    cy.url().should('include', '/admin/dashboard')
  })

})
