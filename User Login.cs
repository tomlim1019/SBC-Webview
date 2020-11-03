using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using MySql.Data.MySqlClient;

namespace Draft_Design
{
    public partial class Login : Form
    {
        connection con = new connection();
        string staff_id, staff_name, username, password;
        public Login()
        {
            InitializeComponent();
            
        }

        private void label22_Click(object sender, EventArgs e)
        {

        }

        private void label1_Click(object sender, EventArgs e)
        {

        }

        private void button7_Click_1(object sender, EventArgs e)
        {
            
           //try
           // {
                if (textBox1.Text != "" && textBox2.Text != "")
                {

                    con.Open();
                    string query = "select staff_id,staff_name,username,password from staff WHERE username ='" + textBox1.Text + "' AND password ='" + textBox2.Text + "'";
                    MySqlDataReader row;
                    row = con.ExecuteReader(query);
                    if (row.HasRows)
                    {
                        while (row.Read())
                        {
                            staff_id = row["staff_id"].ToString();
                            staff_name = row["staff_name"].ToString();
                            username = row["username"].ToString();
                            password = row["password"].ToString();

                        }
                        MessageBox.Show("Data found your name is " + staff_name + ".");

                        Form1 obj = new Form1();
                        obj.Show();
                        this.Hide();
                    }
                    else
                    {
                        MessageBox.Show("Data not found", "Information");
                    }
                }
                else
                {
                    MessageBox.Show("Username or Password is empty", "Information");
                }
            //}

            
        }

        private void Login_Load(object sender, EventArgs e)
        {

        }

        private void test()
        {
            string MySQLConnectionString = "datasource=localhost;port=3306;username=root;password=;database=sbc;sslMode=none";
        }
    }
}
