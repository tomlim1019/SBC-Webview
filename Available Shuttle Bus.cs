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
    public partial class Form4 : Form
    {
        string connection = @"server = 127.0.0.1; userid = root; database = sbc";
        MySqlConnection conn = null;
        public Form4()
        {
            InitializeComponent();
        }

        private void Form4_Load(object sender, EventArgs e)
        {
            FillGridView();
        }

        void FillGridView()
        {
            string query = "SELECT * FROM booking";
            conn = new MySql.Data.MySqlClient.MySqlConnection(connection);
            MySqlCommand cmd = new MySqlCommand(query, conn);
            conn.Open();
            MySqlDataAdapter da = new MySqlDataAdapter(cmd);
            DataTable dt = new DataTable();
            da.Fill(dt);
            conn.Close();
            gv1.DataSource = dt;

            DataGridViewButtonColumn bookButtonColumn = new DataGridViewButtonColumn();
            bookButtonColumn.Name = "btn_book";
            bookButtonColumn.Text = "book";
        }

        private void button1_Click(object sender, EventArgs e)
        {
            Form3 obj = new Form3();
            obj.Show();
            this.Hide();
        }
    }
}
